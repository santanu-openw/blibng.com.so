<?php

namespace Zix\CarWash\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Zix\CarWash\Listeners\GetAppPermissionsListener;
use Zix\Core\Events\Seeder\GetAppPermissions;

/**
 * Class EventServiceProvider
 * @package Zix\CarWash\Providers
 */
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
