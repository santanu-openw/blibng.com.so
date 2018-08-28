<?php

namespace Zix\Core\Console\Commands;

use Illuminate\Database\Console\Migrations\BaseCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MigrateCommand extends BaseCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'zix:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate the migrations from the specified module or from all plugins.';

    /**
     * MigrateCommand constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('--------------------------------------------');
        $this->info('| Running New Migrations                   |');
        $this->info('--------------------------------------------');

        $module = $this->argument('module');

        if (!empty($module)) {
            $this->line('Running Migrations For : <info>' . $this->argument('module') . '</info>');
            $this->call('migrate', [
                '--path' => "plugins/" . $this->argument('module') . "/Database/Migrations",
                '--database' => $this->option('database'),
                '--pretend' => $this->option('pretend'),
                '--force' => $this->option('force'),
            ]);

            return;
        }

        $this->laravel['plugins']->all()->map(function($package) {
            $this->line('Running Migrations For : <info>' . $package->name() . '</info>');
            $this->call('migrate', [
                '--path' => "plugins/" . $package->name() . "/Database/Migrations",
                '--database' => $this->option('database'),
                '--pretend' => $this->option('pretend'),
                '--force' => $this->option('force'),
            ]);
        });

    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['module', InputArgument::OPTIONAL, 'The name of module will be used.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['direction', 'd', InputOption::VALUE_OPTIONAL, 'The direction of ordering.', 'asc'],
            ['database', null, InputOption::VALUE_OPTIONAL, 'The database connection to use.'],
            ['pretend', null, InputOption::VALUE_NONE, 'Dump the SQL queries that would be run.'],
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when in production.'],
            ['seed', null, InputOption::VALUE_NONE, 'Indicates if the seed task should be re-run.'],
        ];
    }

}
