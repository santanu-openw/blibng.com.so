<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('core::default.app');
});

Route::get('/bling-admin', function () {
    return view('core::admin.app');
});


Route::any('/paytabs', function () {
    return dd(request()->all());
});

Route::get('test', function () {
    $paytab = new \Zix\CarWash\Libraries\PayTab("info@bling.com.sa", "Ax0Uky9p2MEo6TuaKBoWoWalrT6o4LMEjNzDlJ2owHNCBiNlTbhh8sCAlJYqvL5OyFsUoujUc6xNok9hvrzETbefVcGqYLewqGrP");

    $result = $paytab->create_pay_page([
        //PayTabs Merchant Account Details
        "merchant_email" => "info@bling.com.sa",                         // PayTabs Merchant Account's email address
        'merchant_secretKey' => "Ax0Uky9p2MEo6TuaKBoWoWalrT6o4LMEjNzDlJ2owHNCBiNlTbhh8sCAlJYqvL5OyFsUoujUc6xNok9hvrzETbefVcGqYLewqGrP", // Secret Key can be fount at PayTabs Merchant Dashboard > Mobile Payments > Secret Key

        //Customer's Personal Information
        'title' => "John Doe",            // Customer's Name on the invoice
        'cc_first_name' => "John",        //This will be prefilled as Credit Card First Name
        'cc_last_name' => "Doe",        //This will be prefilled as Credit Card Last Name
        'email' => "customer@email.com",
        'cc_phone_number' => "973",
        'phone_number' => "33333333",
        'billing_address' => "Juffair, Manama, Bahrain",
        'city' => "Manama",
        'state' => "Capital",
        'postal_code' => "97300",
        'country' => "BHR",

        //Customer's Shipping Address (All fields are mandatory)

        'address_shipping' => "Juffair, Manama, Bahrain",
        'city_shipping' => "Manama",
        'state_shipping' => "Capital",
        'postal_code_shipping' => "97300",
        'country_shipping' => "BHR",

        //Product Information
        "products_per_title" => "Mobile Phone", //Product title of the product. If multiple products then add “||” separator
        'currency' => "BHD",                //Currency of the amount stated. 3 character ISO currency code
        "unit_price" => "10",                    //Unit price of the product. If multiple products then add “||” separator.
        'quantity' => "1",                    //Quantity of products. If multiple products then add “||” separator
        'other_charges' => "0",                //Additional charges. e.g.: shipping charges, taxes, VAT, etc.
        'amount' => "10.00",                //Amount of the products and other charges, it should be equal to: amount = (sum of all products’ (unit_price * quantity)) + other_charges
        //This field will be displayed in the invoice as the sub total field

        'discount' => "0",                    //Discount of the transaction. The Total amount of the invoice will be= amount - discount


        "msg_lang" => "english",            //Language of the PayPage to be created. Invalid or blank entries will default to English.(Englsh/Arabic)


        "reference_no" => "0001",        //Invoice reference number in your system
        "site_url" => url('/'), //The requesting website be exactly the same as the website/URL associated with your PayTabs Merchant Account
        'return_url' => url('paytabs'),
        "cms_with_version" => "v1"

    ]);
//    return dd($result);
    return redirect($result->payment_url);
});
