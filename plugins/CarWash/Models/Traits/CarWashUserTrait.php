<?php

namespace Zix\CarWash\Models\Traits;


use Zix\CarWash\Models\Order;

/**
 * Trait CarWashUserTrait
 * @package Zix\CarWash\Models\Traits
 */
trait CarWashUserTrait
{
    /**
     * @return mixed
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }
}