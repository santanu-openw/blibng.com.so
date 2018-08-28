<?php

namespace Zix\PluginBuilder\Console\Commands;

use App\User;
use Illuminate\Console\ConfirmableTrait;
use Illuminate\Database\Console\Migrations\BaseCommand;

/**
 * Class GenerateApiDocs
 * @package Zix\PluginBuilder\Console\Commands
 */
class GenerateApiDocsCommand extends BaseCommand
{

    use ConfirmableTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'zix:docs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Zexus Documentation.';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = User::where('email', 'admin@247labs.com')->first();
        $this->info('--------------------------------------------');
        $this->info('| Generating Api Docs                       |');
        $this->info('--------------------------------------------');
        if ($user) {
            $this->call('api:generate', [
                '--output' => 'public/documentation',
                '--routePrefix' => 'api/*',
                '--header' => 'Authorization: Bearer ' . $user->createToken('TMP-API')->accessToken
            ]);

            $user->tokens()->where('name', 'TMP-API')->delete();
        } else {
            $this->warn('Participant Not Found');
        }
    }


}
