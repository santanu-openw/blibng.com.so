<?php namespace Zix\Core\Database\Seeds;

use Illuminate\Database\Seeder;
use Zix\Core\Database\Seeds\Fakers\FakeBlogsTableSeeder;
use Zix\Core\Database\Seeds\Fakers\FakeContactsTableSeeder;
use Zix\Core\Database\Seeds\Fakers\FakePagesTableSeeder;
use Zix\Core\Database\Seeds\Fakers\FakePartnersTableSeeder;
use Zix\Core\Database\Seeds\Fakers\FakeTestimonialsTableSeeder;
use Zix\Core\Database\Seeds\Fakers\FakeUsersTableSeeder;

class CoreDataBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PageTableSeeder::class);
        $this->call(FakeUsersTableSeeder::class);
        $this->call(FakeBlogsTableSeeder::class);
        $this->call(FakeContactsTableSeeder::class);
        $this->call(FakePartnersTableSeeder::class);
        $this->call(FakeTestimonialsTableSeeder::class);
    }
}
