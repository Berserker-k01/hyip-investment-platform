<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GeneralSetting;

class GeneralSettingSeeder extends Seeder
{
    public function run(): void
    {
        GeneralSetting::firstOrCreate([], [
            'theme' => 1,
            'site_currency' => 'USD',
        ]);
    }
}
