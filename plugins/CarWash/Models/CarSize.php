<?php

namespace Zix\CarWash\Models;

use Spatie\Translatable\HasTranslations;
use Zix\Core\Models\BaseModel;

/**
 * Class CarSize
 * @package Zix\CarWash\Models
 */
class CarSize extends BaseModel
{
    use HasTranslations;
    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'm_operation', 'm_price', 'img_blank', 'img_active', 'order'];

    /**
     * @var array
     */
    protected $translatable = ['name', 'description'];
}
