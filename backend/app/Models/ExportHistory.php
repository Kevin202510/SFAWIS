<?php

namespace App\Models;

use App\Cores\Traits\DateAndTime;
use App\Cores\Traits\HasImpactor;
use Illuminate\Database\Eloquent\Model;

class ExportHistory extends Model
{
    use DateAndTime;
    protected $fillable = [
        'file_name',
        'requested_by_type',
        'requested_by_id',
        'page',
        'status',
    ];

    public function requestedBy()
    {
        return $this->morphTo();
    }
}
