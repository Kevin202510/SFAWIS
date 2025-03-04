<?php

namespace App\Models;

use App\Cores\Traits\DateAndTime;
use App\Enums\WaterLevelSensorStatus;
use Illuminate\Database\Eloquent\Model;

class WaterLevel extends Model
{
    use DateAndTime;

    protected $fillable = [
        'water_level',
        'status',
    ];

    public function getStatusNameAttribute(): string
    {
        return WaterLevelSensorStatus::find($this->status)->label;
    }
}
