<?php

namespace Zix\CarWash\Listeners;


use Zix\Core\Events\Seeder\GetAppPermissions;

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
            ->push('appointments')
            ->push('car@sizes')
            ->push('company@services')
            ->push('invoices')
            ->push('offers')
            ->push('orders')
            ->push('packages')
            ->push('plans')
            ->push('payments@methods')
            ->push('services')
            ->push('team@tasks');
    }
}
