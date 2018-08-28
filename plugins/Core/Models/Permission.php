<?php

namespace Zix\Core\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;
use Zix\Core\Models\Traits\UuidModelTrait;

/**
 * Class Permission
 * @package Zix\Core\Models
 */
class Permission extends SpatiePermission implements \Spatie\Permission\Contracts\Permission
{
    use UuidModelTrait;
    /**
     * @var array
     */
    protected $fillable = ['name', 'guard_name'];
    /**
     * @var string
     */
    protected $guard_name = 'api';
}
