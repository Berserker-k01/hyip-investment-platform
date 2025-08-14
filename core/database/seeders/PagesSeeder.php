<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PagesSeeder extends Seeder
{
    public function run(): void
    {
        Page::firstOrCreate(
            ['name' => 'home'],
            [
                'sections' => ['about'],
                'slug' => 'home',
                'seo_description' => 'Home page',
                'page_order' => 1,
            ]
        );
    }
}
