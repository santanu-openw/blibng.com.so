<?php

namespace Zix\Core\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

/**
 * Class CoreServiceProvider
 * @package Zix\Core\Providers
 */
class CoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        Validator::extend('passcheck', function ($attribute, $value, $parameters)
        {
            return Hash::check($value, Auth::user()->getAuthPassword());
        });
    }


}
