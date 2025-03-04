<?php

namespace App\Models;

use App\Cores\Traits\DateAndTime;
use App\Cores\Traits\HasImpactor;
use App\Enums\SensorConfigurationStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class SensorConfiguration extends Model
{
    use HasImpactor, DateAndTime, SoftDeletes, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['configuration_name', 'description', 'configuration_value', 'status']);
    }

    protected $fillable = [
        'configuration_name',
        'description',
        'configuration_value',
        'status',
    ];

    protected $casts = [
        'configuration_value' => 'object',
        'statusName'
    ];

    public function getStatusNameAttribute(): string
    {
        return SensorConfigurationStatus::labels()[$this->status];
    }
}
