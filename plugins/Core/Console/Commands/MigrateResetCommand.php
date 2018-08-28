<?php

namespace Zix\Core\Console\Commands;

use Illuminate\Console\ConfirmableTrait;
use Illuminate\Database\Console\Migrations\BaseCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Zix\Core\Libraries\plugins\Helpers\Migrator;

class MigrateResetCommand extends BaseCommand
{

    use ConfirmableTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'zix:migrate-reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset the plugins migrations.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->call('zix:migrate-clean');



        $this->call('zix:migrate');

	}

}