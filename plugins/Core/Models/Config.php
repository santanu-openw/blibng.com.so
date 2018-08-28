<?php

namespace Zix\Core\Models;

/**
 * Class Config
 * @package Zix\Core\Models
 */
class Config extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = ['key', 'value', 'status'];
}
