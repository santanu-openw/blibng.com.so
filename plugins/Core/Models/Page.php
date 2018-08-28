<?php

namespace Zix\Core\Models;

use Spatie\Translatable\HasTranslations;

/**
 * Class Page
 * @package Zix\Core\Models
 */
class Page extends BaseModel
{
    use HasTranslations;
    /**
     * @var array
     */
    protected $fillable = ['title', 'slug', 'content'];

    /**
     * @var array
     */
    protected $translatable = ['title', 'content'];
}
