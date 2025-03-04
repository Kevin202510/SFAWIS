<?php

namespace Database\Seeders;

use App\Enums\SensorConfigurationStatus;
use App\Models\SensorConfiguration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SensorConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("sensor_configurations")->truncate();

        SensorConfiguration::create(
            [
                "configuration_name" => "Default",
                "description" => "Default Configuration",
                "configuration_value" => json_encode([
                    "water_level" => [
                        "max" => 1000,
                        "min" => 250,
                    ],
                    "temperature" => [
                        "max" => 20,
                        "min" => 30,
                    ],
                    "humidity" => [
                        "max" => 100,
                        "min" => 2500,
                    ],
                    "soil_moisture"=> [
                        "max"=> 250,
                        "min"=> 500,
                        ],
                ]),
                "status" => SensorConfigurationStatus::ACTIVE,
                "created_by_id" => 1,
                "created_by_type" => "App\Models\User",
                "updated_by_id" => 1,
                "updated_by_type" => "App\Models\User",
            ]
        );

        SensorConfiguration::create(
            [
                "configuration_name" => "KAMATIS",
                "description" => "KAMATIS Configuration",
                "configuration_value" => json_encode([
                    "water_level" => [
                        "max" => 1000,
                        "min" => 250,
                    ],
                    "temperature" => [
                        "max" => 20,
                        "min" => 30,
                    ],
                    "humidity" => [
                        "max" => 100,
                        "min" => 2500,
                    ],
                    "soil_moisture"=> [
                        "max"=> 250,
                        "min"=> 500,
                        ],
                ]),
                "status" => SensorConfigurationStatus::ACTIVE,
                "created_by_id" => 1,
                "created_by_type" => "App\Models\User",
                "updated_by_id" => 1,
                "updated_by_type" => "App\Models\User",
            ]
        );

        SensorConfiguration::create(
            [
                "configuration_name" => "TALONG",
                "description" => "TALONG Configuration",
                "configuration_value" => json_encode([
                    "water_level" => [
                        "max" => 1000,
                        "min" => 250,
                    ],
                    "temperature" => [
                        "max" => 20,
                        "min" => 30,
                    ],
                    "humidity" => [
                        "max" => 100,
                        "min" => 2500,
                    ],
                    "soil_moisture"=> [
                        "max"=> 250,
                        "min"=> 500,
                        ],
                ]),
                "status" => SensorConfigurationStatus::ACTIVE,
                "created_by_id" => 1,
                "created_by_type" => "App\Models\User",
                "updated_by_id" => 1,
                "updated_by_type" => "App\Models\User",
            ]
        );
    }
}
