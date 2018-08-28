<?php

namespace Zix\Core\Providers;

use Zix\Core\Console\Commands\CreateAdminAccountCommand;
use Zix\Core\Console\Commands\GenerateSitemap;

use Illuminate\Support\ServiceProvider;

use Zix\Core\Console\Commands\InstallCommand;
use Zix\Core\Console\Commands\MigrateCommand;
use Zix\Core\Console\Commands\MigrateCleanCommand;
use Zix\Core\Console\Commands\MigrateResetCommand;
use Zix\Core\Console\Commands\MigrateRollbackCommand;

/**
 * Class ConsoleServiceProvider
 * @package Zix\Core\Providers
 */
class ConsoleServiceProvider extends ServiceProvider
{
    /**
     * The available command shortname.
     *
     * @var array
     */
    protected $commands = [
        MigrateCommand::class,
        MigrateRollbackCommand::class,
        MigrateCleanCommand::class,
        MigrateResetCommand::class,
        InstallCommand::class,
        GenerateSitemap::class,
        CreateAdminAccountCommand::class
    ];

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
        $this->commands($this->commands);

    }
}
