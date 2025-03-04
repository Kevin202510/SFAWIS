<?php

namespace Database\Seeders;

use App\Enums\HumiditySensorStatus;
use App\Models\Humidity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HumiditySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('humidities')->truncate();

        for ($i = 0; $i < 50; $i++) {
            Humidity::create([
                'humidity' => number_format(rand(150, 5000) / 100, 2),
                'status' => HumiditySensorStatus::all()[rand(0, 2)],
            ]);
        }
    
    }
}
