<?php

namespace App\Models;

use App\Cores\Traits\DateAndTime;
use App\Enums\SoilMoistureSensorStatus;
use Illuminate\Database\Eloquent\Model;

class SoilMoisture extends Model
{
    use DateAndTime;
    protected $fillable = [
        'soil_moisture',
        'status',
    ];

    public function getStatusNameAttribute(): string
    {
        return SoilMoistureSensorStatus::find($this->status)->label;
    }
}
