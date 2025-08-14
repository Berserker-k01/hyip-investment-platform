<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            GeneralSettingSeeder::class,
            PagesSeeder::class,
            PlansSeeder::class,
            SectionDataSeeder::class,
        ]);
    }
}
