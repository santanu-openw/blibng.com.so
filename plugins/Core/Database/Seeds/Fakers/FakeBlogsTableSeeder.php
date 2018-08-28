<?php namespace Zix\Core\Database\Seeds\Fakers;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Zix\Core\Models\Blog;

class FakeBlogsTableSeeder extends Seeder
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
            $title = $faker->text;

            Blog::create([
                'name' => $faker->name,
                'title' => $title,
                'slug' => str_slug($title),
                'description' => $faker->text
            ]);
        }
    }
}
