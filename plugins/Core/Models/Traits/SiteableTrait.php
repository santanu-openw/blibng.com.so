<?php

namespace Zix\Core\Models\Traits;

use Zix\Core\Models\Site;

/**
 * Trait SiteableTrait
 * @package Zix\Core\Models\Traits
 */
trait SiteableTrait
{
    /**
     * @TODO:: need to auto prepend the current model to the site() helper
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sites()
    {
        return $this->morphToMany(Site::class, 'siteable');
    }
}