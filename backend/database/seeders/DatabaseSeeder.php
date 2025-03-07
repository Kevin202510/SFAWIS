<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            // HumiditySeeder::class,
            SensorConfigurationSeeder::class,
            // NotificationSeeder::class,
            // TemperatureSeeder::class,
            UserSeeder::class,
            SensorControlSeeder::class,
            // WaterLevelSeeder::class,
            // SoilMoistureSeeder::class,
        ]);
    }
}
