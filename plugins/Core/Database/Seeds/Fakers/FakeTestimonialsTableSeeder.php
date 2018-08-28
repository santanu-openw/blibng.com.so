<?php namespace Zix\Core\Database\Seeds\Fakers;


use Faker\Factory;
use Illuminate\Database\Seeder;
use Zix\Core\Models\Testimonial;

class FakeTestimonialsTableSeeder extends Seeder
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

            Testimonial::create([
                'customer_name' => $faker->name,
                'customer_avatar' => $faker->imageUrl(40, 40),
                'like' => $faker->boolean,
                'comment' => $faker->text,
            ]);
        }
    }
}
