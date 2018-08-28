<?php namespace Zix\CarWash\Database\Seeds;

use Illuminate\Database\Seeder;


class CarWashDataBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PackagesTableSeeder::class);
        $this->call(CarSizesTableSeeder::class);
    }
}
