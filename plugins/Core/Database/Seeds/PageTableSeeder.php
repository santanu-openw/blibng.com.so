<?php namespace Zix\Core\Database\Seeds;

use Illuminate\Database\Seeder;
use Zix\Core\Models\Page;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::create([
            'title' => [
                'en' => 'About Us',
                'ar' => 'من نحن'
            ],
            'slug' => str_slug('About Us'),
            'content' => [
                'en' => 'SOME CONTENT',
                'ar' => 'SOME CONTENT',
            ]
        ]);
    }
}
