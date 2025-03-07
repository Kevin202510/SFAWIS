<?php

namespace App\Models;

use App\Cores\Traits\DateAndTime;
use App\Enums\Activation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class SensorControl extends Model
{
    use DateAndTime, SoftDeletes, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['name', 'status']);
    }

    protected $fillable = [
        'name',
        'status',
    ];

    public function getStatusNameAttribute(): string
    {
        return Activation::labels()[$this->status];
    }
}
