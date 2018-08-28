<?php

namespace Zix\CarWash\Models;

use Spatie\Translatable\HasTranslations;
use Zix\Core\Models\BaseModel;

/**
 * Class Service
 * @package Zix\CarWash\Models
 */
class Service extends BaseModel
{
    use HasTranslations;
    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'price', 'service_time', 'order'];
    /**
     * @var array
     */
    protected $translatable = ['name', 'description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function packages()
    {
        return $this->hasManyThrough(Package::class, 'package_services');
    }
}
