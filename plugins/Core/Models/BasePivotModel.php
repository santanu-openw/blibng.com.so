<?php

namespace Zix\Core\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Zix\Core\Models\Traits\UuidModelTrait;

/**
 * Class BaseModel
 * @package Zix\Core\Models
 */
class BasePivotModel extends Pivot
{
    use UuidModelTrait;

    protected $guard_name = 'api';
}