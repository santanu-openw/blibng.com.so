<?php namespace Zix\Core\Database\Seeds\Fakers;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Zix\Core\Models\Contact;

class FakeContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        foreach (range(1, 10) as $rang) {

            Contact::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'mobile_number' => $faker->phoneNumber,
                'subject' => $faker->text,
                'message' => $faker->text,
            ]);
        }
    }
}
