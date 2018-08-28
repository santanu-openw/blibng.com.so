<?php

namespace Zix\Core\Models;

use Spatie\Translatable\HasTranslations;

/**
 * Class Blog
 * @package Zix\Core\Models
 */
class Blog extends BaseModel
{
    use HasTranslations;
    /**
     * @var array
     */
    protected $fillable = ['name', 'title', 'slug', 'description'];


    /**
     * @var array
     */
    protected $translatable = ['name', 'title', 'slug', 'description'];
}
