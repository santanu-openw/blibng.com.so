<?php

namespace Zix\CarWash\Models;

use Zix\Core\Models\BaseModel;

/**
 * Class Offer
 * @package Zix\CarWash\Models
 */
class Offer extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = ['package_id', 'name', 'starts_at', 'ends_at', 'number_of_free_washes'];

    /**
     * @var array
     */
    protected $dates = ['starts_at', 'ends_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
