<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    static $password;
    $user_id = str_pad((App\User::all()->count() + 1), 4, "0", STR_PAD_LEFT);

    return [
        'user_id' => $user_id,
        'first_name' => $faker->name . '-' . rand(888, 23423),
        'last_name' => $faker->name . '-' . rand(888, 23423),
        'email' => rand(555, 88888) . $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
