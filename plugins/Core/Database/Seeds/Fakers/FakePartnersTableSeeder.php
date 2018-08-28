<?php namespace Zix\Core\Database\Seeds\Fakers;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Zix\Core\Models\Partner;

class FakePartnersTableSeeder extends Seeder
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

            Partner::create([
                'name' => $faker->name,
                'logo' => $faker->imageUrl(40, 40),
                'website_url' => $faker->url,
            ]);
        }
    }
}
