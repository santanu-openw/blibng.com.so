<?php

namespace Zix\Core\Models;

use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * Class Gallery
 * @package Zix\Core\Models
 */
class Gallery extends BaseModel implements HasMedia
{
    use HasMediaTrait;
    /**
     * @var array
     */
    protected $fillable = ['type', 'title'];
}
