<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlansSeeder extends Seeder
{
    public function run(): void
    {
        Plan::firstOrCreate(
            ['name' => 'Starter'],
            [
                'min_deposit' => 10,
                'max_deposit' => 1000,
                'profit_rate' => 5,
                'profit_type' => 'percent',
                'duration_days' => 30,
                'status' => 1,
            ]
        );
    }
}
