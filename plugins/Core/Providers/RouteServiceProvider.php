<?php

namespace Zix\Core\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;


class RouteServiceProvider extends ServiceProvider
{

    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Zix\Core\Http\Controllers';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        $this->registerRoutes();
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    public function registerRoutes()
    {
        Route::group([
            'namespace' => $this->namespace,
            'prefix' => env('API_PREFIX')
        ], function () {

            $files = File::files(__DIR__ . '/../Http/Routes');

            foreach ($files as $file) {
                File::getRequire($file);
            }
        });
    }

}
