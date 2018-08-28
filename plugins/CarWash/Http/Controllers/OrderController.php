<?php


namespace Zix\CarWash\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use PragmaRX\Countries\Package\Countries;
use Zix\CarWash\Http\Requests\Customer\StoreOrderRequest;
use Zix\CarWash\Http\Resources\OrderResource;
use Zix\CarWash\Libraries\PayTab;
use Zix\CarWash\Models\Order;
use Zix\Core\Support\Traits\ApiResponses;

/**
 * Class OrderController
 * @package Zix\CarWash\Http\Controllers
 */
class OrderController
{
    use ApiResponses;

    public function getPrice(Request $request, Order $order)
    {
        return $order->calculateOrderPrice();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function all(Request $request)
    {
        return OrderResource::collection($request->user()->orders()->loadRelatedData()->get());
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        if ($request->user()->orders()->count()) {
            return new OrderResource($request->user()->orders()->loadRelatedData()->first());
        }
    }

    /**
     * @param Request $request
     * @param Order $order
     * @return mixed
     */
    public function show(Request $request, Order $order)
    {
        return new OrderResource($request->user()->orders()->loadRelatedData()->find($order->id));
    }

    /**
     * @param StoreOrderRequest $request
     * @return mixed
     */
    public function store(StoreOrderRequest $request)
    {
        $order = $request->user()->orders()->create($request->input());

        return $this->updateAndReturnOrder($request, $order);
    }

    /**
     * @param StoreOrderRequest $request
     * @param $order
     * @return OrderResource
     */
    public function update(StoreOrderRequest $request, $order)
    {
        $order = $request->user()->orders()->find($order);
        $order->update($request->input());

        return $this->updateAndReturnOrder($request, $order);
    }

    /**
     * @param Request $request
     * @param Order $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function orderProceed(Request $request, Order $order)
    {
        $user = $request->user();
        $user->update($request->input());

        $bill_number = $this->getOrderId();

        $starts_at = $order->starts_at ?: Carbon::now();
        $ends_at = $starts_at->addDays($order->plan->period_days);

        $order->bill_number = $bill_number;
        $order->price = $order->calculateOrderPrice();
        $order->starts_at = $starts_at;
        $order->ends_at = $ends_at;
        $order->save();

        $countries = new Countries();
        $country = $countries->where('name.common', $user->country)->first();
        $paytab = new PayTab(env('PAY_TAB_MERCHANT_MAIL'), env('PAY_TAB_SECRET_KEY'));

        $result = $paytab->create_pay_page([
            //PayTabs Merchant Account Details
            "merchant_email" => env('PAY_TAB_MERCHANT_MAIL'),                         // PayTabs Merchant Account's email address
            'merchant_secretKey' => env('PAY_TAB_SECRET_KEY'), // Secret Key can be fount at PayTabs Merchant Dashboard > Mobile Payments > Secret Key

            //Customer's Personal Information
            'title' => $user->full_name,            // Customer's Name on the invoice
            'cc_first_name' => explode(' ', $user->full_name)[0],        //This will be prefilled as Credit Card First Name
            'cc_last_name' => explode(' ', $user->full_name)[1],        //This will be prefilled as Credit Card Last Name
            'email' => $user->email,
            'cc_phone_number' => $user->phone_number,
            'phone_number' => $user->phone_number,
            'billing_address' => $user->address,
            'city' => $user->city,
            'state' => $user->city,
            'postal_code' => $user->code_postal,
            'country' => $country->iso_a3,

            //Customer's Shipping Address (All fields are mandatory)
            'address_shipping' => $user->address,
            'city_shipping' => $user->city,
            'state_shipping' => $user->city,
            'postal_code_shipping' => $user->code_postal,
            'country_shipping' => $country->iso_a3,

            //Product Information
            "products_per_title" => $order->package->name . ' - ' . $order->package->description, //Product title of the product. If multiple products then add “||” separator
            'currency' => "BHD",                //Currency of the amount stated. 3 character ISO currency code
            // TODO get old order unit price - this new one
            "unit_price" => (float)($order->calculateOrderPrice() / $order->getTotalWashes()),                    //Unit price of the product. If multiple products then add “||” separator.
            'quantity' => $order->getTotalWashes(),                    //Quantity of products. If multiple products then add “||” separator
            'other_charges' => "0",                //Additional charges. e.g.: shipping charges, taxes, VAT, etc.
            'amount' => (float)$order->calculateOrderPrice(),                //Amount of the products and other charges, it should be equal to: amount = (sum of all products’ (unit_price * quantity)) + other_charges
            //This field will be displayed in the invoice as the sub total field

            'discount' => ($order->paid_price),                    //Discount of the transaction. The Total amount of the invoice will be= amount - discount


            "msg_lang" => "arabic",            //Language of the PayPage to be created. Invalid or blank entries will default to English.(Englsh/Arabic)


            "reference_no" => $bill_number,        //Invoice reference number in your system
            "site_url" => url('/'), //The requesting website be exactly the same as the website/URL associated with your PayTabs Merchant Account
            'return_url' => url('api/order/' . $order->id . '/completed/' . $this->getHashedOrder($order)),
            "cms_with_version" => "v1"

        ]);


        return response()->json($result);
    }

    /**
     * @param Request $request
     * @param Order $order
     * @param $hash
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Order
     */
    public function completeOrder(Request $request, Order $order, $hash)
    {
        if ($this->getHashedOrder($order) === $hash) {
            $order->update([
                'status' => 'Paid',
                'paid_price' => $order->calculateOrderPrice(),
                'payment_reference' => $request->get('payment_reference')
            ]);

            $order->invoices()->create([
                'order_obj' => $order->load([
                    'package',
                    'package.services' => function ($query) {
                        return $query->orderBy('order');
                    },
                    'plan',
                    'carSize',
                    'services',
                    'appointments'
                ])
            ]);

            return redirect('/#/orders');
        }

        return redirect('/#/orders');
    }

    /**
     * @param Request $request
     * @param $order
     * @return mixed
     */
    public function destroy(Request $request, $order)
    {
        $request->user()->orders()->find($order)->delete();
        return $order;
    }

    /**
     * @param Order $order
     * @param StoreOrderRequest $request
     */
    private function updateOrderServices(Order $order, StoreOrderRequest $request)
    {
        if ($request->has('services')) {
            $services = [];
            foreach ($request->get('services') as $service) {
                $services[] = $service['id'];
            }
            $order->services()->sync($services);
        }
    }

    /**
     * @param Order $order
     * @param StoreOrderRequest $request
     */
    private function updateAppointments(Order $order, StoreOrderRequest $request)
    {
        if ($request->has('appointments')) {
            $appointments = [];
            foreach ($request->get('appointments') as $appointment) {
                if (array_key_exists('id', $appointment)) {
                    $order->appointments()->find($appointment['id'])->update($appointment);
                } else {
                    $appointment = $order->appointments()->create($appointment);
                }
                $appointments[] = $appointment['id'];
            }

            $order->appointments()->whereNotIn('id', $appointments)->delete();
        }
    }

    /**
     * @return string
     */
    protected function getOrderId(): string
    {
        if (Order::where('status', 'Paid')->get()->count()) {
            $latest_id = (int)Order::where('status', 'Paid')->orderByDesc('bill_number')->first()->bill_number;
        } else {
            $latest_id = 0;
        }
        return str_pad(($latest_id + 1), 4, "0", STR_PAD_LEFT);
    }

    /**
     * @param Order $order
     * @return string
     */
    private function getHashedOrder(Order $order): string
    {
        return md5($order->id . 'D@D' . env('PAY_TAB_SECRET_KEY') . $order->calculateOrderPrice());
    }

    /**
     * @param StoreOrderRequest $request
     * @param $order
     * @return OrderResource
     */
    private function updateAndReturnOrder(StoreOrderRequest $request, $order): OrderResource
    {
        $this->updateOrderServices($order, $request);
        $this->updateAppointments($order, $request);

        return new OrderResource($order->load([
            'package',
            'package.services' => function ($query) {
                return $query->orderBy('order');
            },
            'plan',
            'carSize',
            'services'
        ]));
    }
}