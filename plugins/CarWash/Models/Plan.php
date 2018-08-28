<?php

namespace Zix\CarWash\Models;

use Zix\Core\Models\BaseModel;

/**
 * Class Plan
 * @package Zix\CarWash\Models
 */
class Plan extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'period_days', 'm_operation', 'm_price', 'order', 'img_blank', 'img_active'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function packages()
    {
        return $this->belongsToMany(Package::class, 'package_plans');
    }
}
