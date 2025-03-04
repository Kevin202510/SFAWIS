<?php

namespace App\Models;

use App\Cores\Traits\DateAndTime;
use App\Cores\Traits\HasImpactor;
use App\Enums\SensorConfigurationStatus;
use Illuminate\Database\Eloquent\Model;

class SensorConfiguration extends Model
{
    use HasImpactor, DateAndTime;

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
        return SensorConfigurationStatus::find($this->status)->label;
    }
}
