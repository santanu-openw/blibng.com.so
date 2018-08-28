<?php

namespace Zix\Core\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Zix\Core\Events\Seeder\GetAppPermissions;
use Zix\Core\Events\UserRegistered;
use Zix\Core\Listeners\GetAppPermissionsListener;
use Zix\Core\Listeners\UserRegisteredListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        GetAppPermissions::class => [
            GetAppPermissionsListener::class,
        ],
        UserRegistered::class => [
            UserRegisteredListener::class
        ]
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }


}
