<?php

namespace Zix\CarWash\Models;

use Zix\Core\Models\BaseModel;

/**
 * Class Invoice
 * @package Zix\CarWash\Models
 */
class Invoice extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = ['order_obj'];

    /**
     * @var array
     */
    protected $casts = [
        'order_obj' => 'array'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
