<?php

namespace Zix\Core\Models;

use App\User;

/**
 * Class Contact
 * @package Zix\Core\Models
 */
class Contact extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'email', 'mobile_number', 'subject', 'message', 'customer_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
