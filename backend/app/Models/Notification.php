<?php

namespace App\Models;

use App\Cores\Traits\DateAndTime;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use DateAndTime;

    protected $fillable = [
        'user_id',
        'title',
        'message',
        'is_read',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
