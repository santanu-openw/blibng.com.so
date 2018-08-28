<?php

namespace Zix\Core\Models;

use Spatie\MediaLibrary\Models\Media as SpatieMedia;
use Zix\Core\Models\Traits\UuidModelTrait;

/**
 * Class Media
 * @package Zix\Core\Models
 */
class Media extends SpatieMedia
{
    use UuidModelTrait;

    protected $guard_name = 'api';

}
