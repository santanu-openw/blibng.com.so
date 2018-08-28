<?php namespace Zix\CarWash\Database\Seeds;

use Illuminate\Database\Seeder;
use Zix\CarWash\Models\CarSize;

class CarSizesTableSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $car_1 = CarSize::create([
            'name' => [
                'ar' => 'حجم مني',
                'en' => 'small size'
            ],
            'description' => [
                'ar' => 'حجم مني',
                'en' => 'small size'
            ],
            'm_price' => 50,
            'order' => 0,
            'img_blank' => '/images/cars/small-car.png',
            'img_active' => '/images/cars/small-car-active.png'
        ]);

        $car_2 = CarSize::create([
            'name' => [
                'ar' => 'حجم متوسطة',
                'en' => 'Medium size'
            ],
            'description' => [
                'ar' => 'حجم متوسطة',
                'en' => 'Medium size'
            ],
            'm_price' => 80,
            'order' => 1,
            'img_blank' => '/images/cars/medium-car.png',
            'img_active' => '/images/cars/medium-car-active.png'
        ]);

        $car_3 = CarSize::create([
            'name' => [
                'ar' => 'حجم كبير',
                'en' => 'big size'
            ],
            'description' => [
                'ar' => 'حجم كبير',
                'en' => 'big size'
            ],
            'm_price' => 100,
            'order' => 2,
            'img_blank' => '/images/cars/large-car.png',
            'img_active' => '/images/cars/large-car-active.png'
        ]);

        $car_4 = CarSize::create([
            'name' => [
                'ar' => 'حجم كبير جدا',
                'en' => 'Very large size'
            ],
            'description' => [
                'ar' => 'حجم كبير جدا',
                'en' => 'Very large size'
            ],
            'm_price' => 150,
            'order' => 3,
            'img_blank' => '/images/cars/very-large-car.png',
            'img_active' => '/images/cars/very-large-car.png'
        ]);
    }


}
