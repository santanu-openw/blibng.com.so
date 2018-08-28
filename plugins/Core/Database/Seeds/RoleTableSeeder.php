<?php namespace Zix\Core\Database\Seeds;

use Illuminate\Database\Seeder;
use Zix\Core\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Manager']);
        Role::create(['name' => 'Team']);
        Role::create(['name' => 'User']);
    }
}
