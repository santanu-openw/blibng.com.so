<?php

namespace Zix\PluginBuilder\Console\Commands;

use Illuminate\Console\Command;
use Zix\PluginBuilder\Console\Generators\PluginGenerator;

class MakeModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zix:make {name : The module name}
                                     {--empty : Generate Empty Module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Module.';

    /**
     * @var PluginGenerator
     */
    private $moduleGenerator;

    /**
     * Create a new command instance.
     * @param PluginGenerator $moduleGenerator
     */
    public function __construct(PluginGenerator $moduleGenerator)
    {
        parent::__construct();
        $this->moduleGenerator = $moduleGenerator;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $this->moduleGenerator
            ->setConsole($this)
            ->generate();


        // Generate Main Provider
        $this->call("zix:make-provider", [
            'name' => "{$name}ServiceProvider",
            'module' => $name,
        ]);
        $this->call("zix:make-provider", [
            'name' => "AssetsServiceProvider",
            'module' => $name,
        ]);
        $this->call("zix:make-provider", [
            'name' => "ConsoleServiceProvider",
            'module' => $name,
        ]);
        $this->call("zix:make-provider", [
            'name' => "EventServiceProvider",
            'module' => $name,
        ]);
        $this->call("zix:make-provider", [
            'name' => "RouteServiceProvider",
            'module' => $name,
        ]);

        // Generate Main Model
        $this->call("zix:crud", [
            'name' => $name,
            'module' => $name,
        ]);


    }
}
