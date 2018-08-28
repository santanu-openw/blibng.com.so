<?php namespace Zix\Core\Libraries\Plugins;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Zix\Core\Libraries\Plugins\Contracts\PackagerInterface;

/**
 * Class PluginsServiceProvider
 * @package Zix\Core\Libraries\Plugins
 */
class PluginsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('plugins', function ($app) {
            return new Plugins($app['filesystem']);
        });
        $this->registerPluginsProviders();
        $this->bindContracts();

    }

    /**
     * Register All Enabled plugins Providers.
     */
    public function registerPluginsProviders()
    {
        $this->app['plugins']->enabledPlugins()->map(function ($package) {
            $this->registerProviders($package->providers());
            $this->registerAlias($package->aliases());
            $this->requiredFiles($package->config()->files, $package->name());
        });
    }

    /**
     * Bind plugins Contracts
     */
    public function bindContracts()
    {
        $this->app->bind(PackagerInterFace::class, Packager::class);
    }

    /**
     * Register App Providers
     * @param array $providers
     */
    public function registerProviders(array $providers)
    {
        foreach ($providers as $provider) {
            $this->app->register($provider);
        }
    }

    /**
     * @param array $aliases
     */
    public function registerAlias(array $aliases)
    {
        foreach ($aliases as $aliase) {
            $this->app->alias($aliase->{"name"}, $aliase->{"class"});
        }
    }

    /**
     * @param array $files
     * @param $module
     */
    public function requiredFiles(array $files, $module)
    {
        foreach ($files as $file) {
//            File::getRequire(base_path('plugins/' . $module . '/' .$file));
        }
    }
}