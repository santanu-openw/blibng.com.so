<?php

namespace Zix\Core\Models;

use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Translatable\HasTranslations;

/**
 * Class Partner
 * @package Zix\Core\Models
 */
class Partner extends BaseModel implements HasMedia
{
    use HasTranslations, HasMediaTrait;
    /**
     * @var array
     */
    protected $fillable = ['name', 'logo', 'website_url'];

    /**
     * @var array
     */
    protected $translatable = ['name'];
}
