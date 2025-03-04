<?php

namespace App\Models;

use App\Cores\Traits\DateAndTime;
use App\Enums\HumiditySensorStatus;
use Illuminate\Database\Eloquent\Model;

class Humidity extends Model
{
    use DateAndTime;
    protected $fillable = [
        'humidity',
        'status',
    ];

    public function getStatusNameAttribute(): string
    {
        return HumiditySensorStatus::find($this->status)->label;
    }
}
