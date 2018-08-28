<?php

namespace Zix\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Zix\Core\Models\Traits\UuidModelTrait;

/**
 * Class BaseModel
 * @package Zix\Core\Models
 */
class BaseModel extends Model
{
    use UuidModelTrait;

    protected $guard_name = 'api';
}