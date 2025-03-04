<?php

namespace App\Cores\Traits;

trait DateAndTime
{
    public function getDateAttribute($date)
    {   if ($date instanceof \DateTime) {
            $date = $date->format("Y-m-d");
            return $date;
        }
    }

    public function getTimeAttribute($dateTime)
    {
        if ($dateTime instanceof \DateTime) {
            $dateTime = $dateTime->format("H:i:s");
            return $dateTime;
        }
    }
}