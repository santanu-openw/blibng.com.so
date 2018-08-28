<?php

namespace Zix\CarWash\Models;

use Zix\Core\Models\BaseModel;

/**
 * Class Appointment
 * @package Zix\CarWash\Models
 */
class Appointment extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = ['year', 'month', 'day', 'hour', 'week', 'car_numbers', 'client_notes', 'team_notes', 'completed', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
