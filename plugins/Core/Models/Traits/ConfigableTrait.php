<?php

namespace Zix\Core\Models\Traits;

use Zix\Core\Models\Config;

/**
 * Trait ConfigableTrait
 * @package Zix\Core\Models\Traits
 */
trait ConfigableTrait
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function configs()
    {
        return $this->morphToMany(Config::class, 'configable');
    }
}