<?php namespace Zix\Core\Database\Seeds\Fakers;

use App\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

/**
 * Class UsersTableSeeder
 * @package Zix\Core\Database\Seeds
 */
class FakeUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        // TODO:: remove in production
        foreach (range(1, 10) as $range) {
            $this->createUserAccount($faker)->assignRole('User');
        }
    }

    /**
     * @param $faker
     * @return User
     */
    protected function createUserAccount($faker): User
    {
        return User::create([
            'user_id' => $this->getUserId(),
            'avatar' => $faker->imageUrl(40, 40),
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'email' => $faker->unique()->safeEmail,
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
