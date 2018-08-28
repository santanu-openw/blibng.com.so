<?php

namespace Zix\Core\Listeners;

use Zix\Core\Events\Seeder\GetAppPermissions;

/**
 * Class GetAppPermissionsListener
 * @package Zix\Core\Listeners\Seeder
 */
class GetAppPermissionsListener
{
    /**
     * Handle the event.
     *
     * @param GetAppPermissions $event
     * @return void
     */
    public function handle(GetAppPermissions $event)
    {
        $event->collection
            ->push('admin@dashboard')
            ->push('users')
            ->push('permission')
            ->push('roles')
            ->push('pages')
            ->push('blogs')
            ->push('partners')
            ->push('testimonials')
            ->push('contacts')
            ->push('translations')
            ->push('galleries')

            ;
    }
}
