<?php

namespace App\Models;

use App\Cores\Traits\DateAndTime;
use App\Enums\TemperatureSensorStatus;
use Illuminate\Database\Eloquent\Model;

class Temperature extends Model
{
    use DateAndTime;
    protected $fillable = [
        'temperature',
        'status',
    ];

    public function getStatusNameAttribute(): string
    {
        return TemperatureSensorStatus::labels()[$this->status];
    }
}
