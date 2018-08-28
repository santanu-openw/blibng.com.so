<?php

namespace Zix\Core\Console\Commands;

use App\User;
use Illuminate\Console\ConfirmableTrait;
use Illuminate\Console\GeneratorCommand;
use Zix\Core\Console\Generators\Traits\StubGeneratorTrait;

class CreateAdminAccountCommand extends GeneratorCommand
{
    use StubGeneratorTrait, ConfirmableTrait;
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'zix:create-admin';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create Admin Account';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->createAdminRoles();
        $this->createAdminAccount();
    }

    /**
     * Create admin roles
     */
    private function createAdminRoles()
    {
        $this->info('--------------------------------------------');
        $this->info('| Creating Admin Full Access Role          |');
        $this->info('--------------------------------------------');

        $this->info('Administration Roles Created Successfully. ');
    }

    /**
     * create admin account
     */
    private function createAdminAccount()
    {
        $this->info('--------------------------------------------');
        $this->info('| Creating Administration Account          |');
        $this->info('--------------------------------------------');

        $email    = $this->ask('Email Address');
        $password = $this->secret('Password');
        $user_id = str_pad((User::all()->count() + 1), 4, "0", STR_PAD_LEFT);
        $user = User::create([
            'user_id'       => $user_id,
            'email'         => $email,
            'password'      => bcrypt($password),
            'email_active'  => true
        ]);

        $user->assignRole('Admin');

        $this->info('Congrats '. $email . ' You successfully created an admin account !');
    }
}
