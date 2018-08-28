<?php

namespace Zix\Core\Models;

use App\User;

/**
 * Class Testimonial
 * @package Zix\Core\Models
 */
class Testimonial extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = ['customer_name', 'customer_avatar', 'like', 'comment', 'customer_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
