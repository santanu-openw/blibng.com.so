<?php

namespace Zix\CarWash\Models;

use App\User;
use Zix\Core\Models\BaseModel;

/**
 * Class Order
 * @package Zix\CarWash\Models
 */
class Order extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = ['customer_id', 'package_id', 'plan_id', 'car_size_id', 'bill_number', 'status', 'price', 'paid_price', 'payment_reference'];

    /**
     * @var array
     */
    protected $dates = ['starts_at', 'ends_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carSize()
    {
        return $this->belongsTo(CarSize::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function services()
    {
        return $this->belongsToMany(Service::class, 'order_services');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeLoadRelatedData($query)
    {
        return $query->with([
            'package',
            'package.services' => function ($query) {
                return $query->orderBy('order');
            },
            'plan',
            'carSize',
            'services',
            'appointments'
        ]);
    }

    public function getTotalWashes()
    {
        $washes = 0;
        $period = (int)$this->plan->period_days;
        $washes_per_week = (int)$this->package->number_of_washes_per_week;


        return (int) (($period / 7) * $washes_per_week);
    }

    /**
     * @return int
     */
    public function calculateOrderPrice()
    {
        $price = 0;
        $this->load(['services']);
        if ($this->services->count()) {
            $price += $this->services->sum('price');
        }

        if ($this->package) {
            $price = $this->calculateOperation($price, $this->package->m_operation, $this->package->m_price);
        }
        if ($this->plan) {
            $price = $this->calculateOperation($price, $this->plan->m_operation, $this->plan->m_price);
        }
        if ($this->carSize) {
            $price = $this->calculateOperation($price, $this->carSize->m_operation, $this->carSize->m_price);
        }

        return $price;
    }

    /**
     * @param $total
     * @param $operation
     * @param $price
     * @return float|int
     */
    private function calculateOperation($total, $operation, $price)
    {
        switch ($operation) {
            case "+":
                return $total + $price;
            case "-":
                return $total - $price;

            case "*":
                return $total * $price;

            case "/":
                return $total / $price;

            default :
                return $total + $price;
        }
    }
}
