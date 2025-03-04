<?php

namespace Database\Seeders;

use App\Enums\WaterLevelSensorStatus;
use App\Models\WaterLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WaterLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('water_levels')->truncate();

        for ($i = 0; $i < 50; $i++) {
            WaterLevel::create([
                'water_level' => number_format(rand(150, 10000) / 100, 2),
                'status' => WaterLevelSensorStatus::all()[rand(0, 2)],
            ]);
        }
    }
}
