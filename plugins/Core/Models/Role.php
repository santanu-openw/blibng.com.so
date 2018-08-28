<?php

namespace Zix\Core\Models;

use Spatie\Permission\Models\Role as SpatieRole;
use Zix\Core\Models\Traits\UuidModelTrait;

/**
 * Class Role
 * @package Zix\Core\Models
 */
class Role extends SpatieRole implements \Spatie\Permission\Contracts\Role
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
