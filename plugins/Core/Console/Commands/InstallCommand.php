<?php

namespace Zix\Core\Console\Commands;


use Illuminate\Console\ConfirmableTrait;
use Illuminate\Database\Console\Migrations\BaseCommand;

class InstallCommand extends BaseCommand
{

    use ConfirmableTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'zix:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install All Zexus Application.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \Plugins::update();
        // put the app in maintenance mode
        $this->call('down');

        // clean cache
        $this->call('cache:clear');

        // generate app key
        $this->call('key:generate');

        // migrate database
        $this->call('zix:migrate');
        $this->call('migrate');

        // migrate|install passport
        $this->call('passport:install');

        // seed database
        $this->call('zix:db-seed');

        // create admin account
//        $this->call('zix:create-admin');

        // set the first site up

        // put the app in live mode
        $this->call('up');

    }

}