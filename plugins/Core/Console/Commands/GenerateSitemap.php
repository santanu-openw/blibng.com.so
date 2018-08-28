<?php

namespace Zix\Core\Console\Commands;

use Illuminate\Console\GeneratorCommand;
//use Zix\Core\Events\Seo\GenerateSitemap as GenerateSitemapEvent;

class GenerateSitemap extends GeneratorCommand
{

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'zix:sitemap';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';


	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$this->info('--------------------------------------------');
		$this->info('| Generating SiteMaps                       |');
		$this->info('--------------------------------------------');
//		event(new GenerateSitemapEvent());
	}

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		// TODO: Implement getStub() method.
	}

}
