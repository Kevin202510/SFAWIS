<?php

namespace App\Models;

use App\Cores\Traits\DateAndTime;
use App\Enums\Activation;
use Illuminate\Database\Eloquent\Model;

class SensorControl extends Model
{
    use DateAndTime;

    protected $fillable = [
        'name',
        'status',
    ];

    public function getStatusNameAttribute(): string
    {
        return Activation::find($this->status)->label;
    }
}
