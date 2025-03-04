<?php

namespace App\Models;

use App\Cores\Traits\DateAndTime;
use App\Cores\Traits\HasImpactor;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasImpactor, DateAndTime;

    protected $fillable = [
        "reference_type",
        "reference_id",
        "action",
        "before_change",
        "after_change",
        "route_name",
    ];

    protected $casts = [
        'before_change' => 'json',
        'after_change' => 'json',
    ];
}
