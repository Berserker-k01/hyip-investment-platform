<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SectionData;

class SectionDataSeeder extends Seeder
{
    public function run(): void
    {
        SectionData::firstOrCreate(
            ['key' => 'homepage'],
            [
                'data' => null,
                'sections' => ['about'],
            ]
        );
    }
}
