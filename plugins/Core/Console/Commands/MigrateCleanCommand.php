<?php

namespace Zix\Core\Console\Commands;

use Illuminate\Console\ConfirmableTrait;
use Illuminate\Database\Console\Migrations\BaseCommand;
use Illuminate\Database\Migrations\Migrator;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MigrateCleanCommand extends BaseCommand
{

	use ConfirmableTrait;

	/**
	 * The migrator instance.
	 *
	 * @var \Illuminate\Database\Migrations\Migrator
	 */
	protected $migrator;


	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'zix:migrate-clean';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Clean all plugins migrations.';



	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
{
	$this->info('--------------------------------------------');
	$this->info('| Running Migrations Back                  |');
	$this->info('--------------------------------------------');

	$plugins = $this->laravel['plugins'];
	$name = $this->argument('module');

	if (!empty($name)) {
		return $this->rollback($plugins->get($name));;
	}

	$plugins->all()->map(function($package) {
		$this->line('Running for module: <info>' . $package->name() . '</info>');
		$this->rollback($package);
	});

}


	/**
	 * Rollback migration from the specified module.
	 *
	 * @param $module
	 */
	public function rollback($module)
{

	$migrator = new Migrator($module, $this->laravel);

	$migrated = $migrator->reset();

	if (count($migrated)) {
		foreach ($migrated as $migration) {
			$this->line("Rollback: <info>{$migration}</info>");
		}
		return;
	}

	$this->comment('Nothing to rollback.');

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

		['database', null, InputOption::VALUE_OPTIONAL, 'The database connection to use.'],

		['force', null, InputOption::VALUE_NONE, 'Force the operation to run when in production.'],

		['pretend', null, InputOption::VALUE_NONE, 'Dump the SQL queries that would be run.'],

		['step', null, InputOption::VALUE_OPTIONAL, 'The number of migrations to be reverted.'],
	];
}
}
