<?php

namespace Zix\CarWash\Models;

use Spatie\Translatable\HasTranslations;
use Zix\Core\Models\BaseModel;

/**
 * Class Package
 * @package Zix\CarWash\Models
 */
class Package extends BaseModel
{
    use HasTranslations;
    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'period', 'trial_period', 'order', 'number_of_washes_per_week', 'm_operation', 'm_price'];

    /**
     * @var array
     */
    protected $translatable = ['name', 'description'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function services()
    {
        return $this->belongsToMany(Service::class, 'package_services');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'package_plans');
    }
}
