<?php

namespace Database\Seeders;

use App\Enums\SoilMoistureSensorStatus;
use App\Models\SoilMoisture;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SoilMoistureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('soil_moistures')->truncate();

        for ($i = 0; $i < 50; $i++) {
            SoilMoisture::create([
                'soil_moisture' => number_format(rand(150, 10000) / 100, 2),
                'status' => SoilMoistureSensorStatus::all()[rand(0, 3)],
            ]);
        }
    }
}
