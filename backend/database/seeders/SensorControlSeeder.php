<?php

namespace Database\Seeders;

use App\Enums\Activation;
use App\Models\SensorControl;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SensorControlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("sensor_controls")->truncate();

        foreach (["temperature", "humidity", "soil moisture", "water level"] as $key => $value) {
            SensorControl::create([
                "name"=> Str::ucfirst($value),
                "status" => Activation::INACTIVE,
            ]);
        }
    }
}
