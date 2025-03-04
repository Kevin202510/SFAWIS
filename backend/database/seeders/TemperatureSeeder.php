<?php

namespace Database\Seeders;

use App\Enums\TemperatureSensorStatus;
use App\Models\Temperature;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemperatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('temperatures')->truncate();

        for ($i = 0; $i < 50; $i++) {
            Temperature::create([
                'temperature' => number_format(rand(150, 2000) / 100, 2),
                'status' => TemperatureSensorStatus::all()[rand(0, 2)],
            ]);
        }
    }
}
