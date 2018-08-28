<?php namespace Zix\Core\Database\Seeds;

use App\User;
use Illuminate\Database\Seeder;

/**
 * Class UsersTableSeeder
 * @package Zix\Core\Database\Seeds
 */
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createManagerAccount()->assignRole('Manager');
    }

    /**
     * @return User
     */
    protected function createManagerAccount(): User
    {
        return User::create([
            'user_id' => $this->getUserId(),
            'first_name' => 'Manager',
            'last_name' => 'Bling',
            'email' => 'admin@bling.com.sa',
            'password' => bcrypt('123456')
        ]);
    }


    /**
     * @return string
     */
    protected function getUserId(): string
    {
        if (User::all()->count()) {
            $latest_id = (int)User::orderByDesc('user_id')->first()->user_id;
        } else {
            $latest_id = 0;
        }
        return str_pad(($latest_id + 1), 4, "0", STR_PAD_LEFT);
    }
}
