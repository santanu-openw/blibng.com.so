<?php namespace Zix\CarWash\Database\Seeds;

use Illuminate\Database\Seeder;
use Zix\CarWash\Models\Package;
use Zix\CarWash\Models\Plan;
use Zix\CarWash\Models\Service;

class PackagesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        list($service_1, $service_2, $service_3, $service_4, $service_5, $service_6, $service_7) = $this->createServices();


        $plan_1 = Plan::create([
            'name' => 'مرة واحدة',
            'description' => 'مرة واحدة',
            'period_days' => 1,
            'm_price' => 50,
            'order' => 1,
            'img_blank' => '/images/calendar-1.png',
            'img_active' => '/images/calendar-1-active.png'
        ]);

        $plan_2 = Plan::create([
            'name' => 'شهر واحد',
            'description' => 'شهر واحد',
            'period_days' => 30,
            'm_price' => 250,
            'order' => 2,
            'img_blank' => '/images/calendar-1.png',
            'img_active' => '/images/calendar-1-active.png'
        ]);

        $plan_3 = Plan::create([
            'name' => 'ثلاث شهور',
            'description' => 'ثلاث شهور',
            'period_days' => 90,
            'm_price' => 350,
            'order' => 3,
            'img_blank' => '/images/calendar-2.png',
            'img_active' => '/images/calendar-2-active.png'
        ]);

        $plan_4 = Plan::create([
            'name' => 'ست شهور',
            'description' => 'ست شهور',
            'm_price' => 550,
            'period_days' => 180,
            'order' => 5,
            'img_blank' => '/images/calendar-3.png',
            'img_active' => '/images/calendar-3-active.png'
        ]);

        $plan_5 = Plan::create([
            'name' => 'سنه واحدة',
            'description' => 'سنه واحدة',
            'm_price' => 750,
            'period_days' => 365,
            'order' => 5,
            'img_blank' => '/images/calendar-4.png',
            'img_active' => '/images/calendar-4-active.png'
        ]);


        // Create Packages
        $package_1 = Package::create([
            'name' => [
                'en' => 'Bronze',
                'ar' => 'الباقة البرونزية'
            ],
            'description' => [
                'en' => 'one time per week',
                'ar' => 'إشتراك لمدة شهر لمرة واحدة في الأسبوع'
            ],
            'number_of_washes_per_week' => 1,
            'order' => 1,
            'm_price' => 20
        ]);


        $package_2 = Package::create([
            'name' => [
                'en' => 'Silver',
                'ar' => 'الباقة الفضية'
            ],
            'description' => [
                'en' => 'Two times per week',
                'ar' => 'إشتراك لمدة شهر لمرتين في الأسبوع'
            ],
            'number_of_washes_per_week' => 2,
            'order' => 2,
            'm_price' => 30
        ]);


        $package_3 = Package::create([
            'name' => [
                'en' => 'Golden',
                'ar' => 'الباقة الذهبية',
            ],
            'description' => [
                'en' => 'Three times per week',
                'ar' => 'إشتراك لمدة شهر تلات مرات في الأسبوع'
            ],
            'number_of_washes_per_week' => 3,
            'order' => 3,
            'm_price' => 40
        ]);


        $package_4 = Package::create([
            'name' => [
                'en' => 'Diamond',
                'ar' => 'الباقة الالماسية'
            ],
            'description' => [
                'en' => 'Four times per week',
                'ar' => 'إشتراك لمدة شهر خمس مرات في الأسبوع'
            ],
            'number_of_washes_per_week' => 4,
            'order' => 4,
            'm_price' => 50
        ]);


        $package_5 = Package::create([
            'name' => [
                'en' => 'Silver Bling',
                'ar' => 'الباقة بلينق الفضية'
            ],
            'description' => [
                'en' => 'Five times per week',
                'ar' => 'إشتراك لمدة شهر خمس مرات في الأسبوع'
            ],
            'number_of_washes_per_week' => 5,
            'order' => 5,
            'm_price' => 60
        ]);

        $package_6 = Package::create([
            'name' => [
                'en' => 'Golden Bling',
                'ar' => 'الباقة بلينق الدهبية',
            ],
            'description' => [
                'en' => 'Six times per week',
                'ar' => 'إشتراك لمدة شهر ست مرات في الأسبوع'
            ],
            'number_of_washes_per_week' => 6,
            'order' => 6,
            'm_price' => 70
        ]);

        $package_7 = Package::create([
            'name' => [
                'en' => 'Diamond Bling',
                'ar' => 'الباقة بلينق  الالماسية'
            ],
            'description' => [
                'en' => 'Seven times per week',
                'ar' => 'إشتراك لمدة شهر ست مرات في الأسبوع'
            ],
            'number_of_washes_per_week' => 7,
            'order' => 7,
            'm_price' => 80
        ]);

        // Attach Packages To Plans
        $packages = [
            $package_1->id,
            $package_2->id,
            $package_3->id,
            $package_4->id,
            $package_5->id,
            $package_6->id,
            $package_7->id,
        ];

        $plan_1->packages()->attach($packages);
        $plan_2->packages()->attach($packages);
        $plan_3->packages()->attach($packages);
        $plan_4->packages()->attach($packages);
        $plan_5->packages()->attach($packages);

        // Attach Services To Packages
        $services = [
            $service_1->id,
            $service_2->id,
            $service_3->id,
            $service_4->id,
            $service_5->id,
            $service_6->id,
            $service_7->id
        ];

        $package_1->services()->attach($services);
        $package_2->services()->attach($services);
        $package_3->services()->attach($services);
        $package_4->services()->attach($services);
        $package_5->services()->attach($services);
        $package_6->services()->attach($services);
        $package_7->services()->attach($services);
    }

    /**
     * @return array
     */
    protected function createServices(): array
    {
        // Create Services
        $service_1 = Service::create([
            'name' => [
                'en' => 'Car wash with steam',
                'ar' => 'غسيل السيارة بالبخار',
            ],
            'description' => [
                'en' => 'Car wash with steam',
                'ar' => 'غسيل السيارة بالبخار',
            ],
            'price' => 150,
            'service_time' => 10,
            'order' => 1
        ]);


        $service_2 = Service::create([
            'name' => [
                'en' => 'Sterilizing the air conditioner',
                'ar' => 'تعقيم المكيف',
            ],
            'description' => [
                'en' => 'Sterilizing the air conditioner',
                'ar' => 'تعقيم المكيف',
            ],
            'price' => 150,
            'service_time' => 10,
            'order' => 2
        ]);


        $service_3 = Service::create([
            'name' => [
                'en' => 'Dice bag',
                'ar' => 'تكيس الدواسلت',
            ],
            'description' => [
                'en' => 'Dice bag',
                'ar' => 'تكيس الدواسلت',
            ],
            'price' => 150,
            'service_time' => 10,
            'order' => 3
        ]);

        $service_4 = Service::create([
            'name' => [
                'en' => 'Mattress mattresses',
                'ar' => 'تكيس مراتب',
            ],
            'description' => [
                'en' => 'Mattress mattresses',
                'ar' => 'تكيس مراتب',
            ],
            'price' => 150,
            'service_time' => 10,
            'order' => 4
        ]);


        $service_5 = Service::create([
            'name' => [
                'en' => 'Polishing of tires',
                'ar' => 'تلميع الإطارات',
            ],
            'description' => [
                'en' => 'Polishing of tires',
                'ar' => 'تلميع الإطارات',
            ],
            'price' => 150,
            'service_time' => 15,
            'order' => 5
        ]);


        $service_6 = Service::create([
            'name' => [
                'en' => 'Refreshing mattresses',
                'ar' => 'معطر للمراتب',
            ],
            'description' => [
                'en' => 'Refreshing mattresses',
                'ar' => 'معطر للمراتب',
            ],
            'price' => 150,
            'service_time' => 3,
            'order' => 6
        ]);


        $service_7 = Service::create([
            'name' => [
                'en' => 'A special towel for your car',
                'ar' => 'منشفة خاصة بسيارتك',
            ],
            'description' => [
                'en' => 'A special towel for your car',
                'ar' => 'منشفة خاصة بسيارتك',
            ],
            'price' => 150,
            'service_time' => 0,
            'order' => 7
        ]);
        return array($service_1, $service_2, $service_3, $service_4, $service_5, $service_6, $service_7);
    }
}
