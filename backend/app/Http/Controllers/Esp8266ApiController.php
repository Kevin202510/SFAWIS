<?php

namespace App\Http\Controllers;

use App\Enums\HumiditySensorStatus;
use App\Enums\SoilMoistureSensorStatus;
use App\Enums\TemperatureSensorStatus;
use App\Enums\WaterLevelSensorStatus;
use App\Models\Humidity;
use App\Models\SoilMoisture;
use App\Models\Temperature;
use App\Models\WaterLevel;
use Illuminate\Http\Request;

class Esp8266ApiController extends Controller
{
    public function index(Request $request)
    {
        try {
            Temperature::create([
                "temperature"=> data_get($request->all(), "temperature"),
                "status"=> TemperatureSensorStatus::labels()[rand(0,2)],
            ]);
    
            Humidity::create([
                "humidity"=> data_get($request->all(),"humidity"),
                "status"=> HumiditySensorStatus::labels()[rand(0,2)],
            ]);
    
            SoilMoisture::create([
                "soil_moisture"=> data_get($request->all(),"soil_moisture"),
                "status"=> SoilMoistureSensorStatus::labels()[rand(0,3)],
            ]);
    
            return response()->json([
                "success" => true,
                "message" => "Data saved successfully",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "success" => false,
                "message" => $th->getMessage(),
            ]);
        }
    }
}
