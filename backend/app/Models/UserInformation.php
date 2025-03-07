<?php

namespace App\Models;

use App\Cores\Traits\DateAndTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserInformation extends Model
{
    use DateAndTime, SoftDeletes;

    protected $fillable = [
        'profile_path',
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'phone_number',
        'address',
        'gender',
        'DOB',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
