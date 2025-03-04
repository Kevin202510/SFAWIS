<?php

namespace App\Enums;

use App\Cores\BaseEnum;

class TemperatureSensorStatus extends BaseEnum
{
    public const HIGH_Temperature = 'high_temperature';
    public const LOW_Temperature = 'low_temperature';
    public const GOOD_Temperature = 'good_temperature';

    public static function all(): array
    {
        return [
            self::HIGH_Temperature,
            self::LOW_Temperature,
            self::GOOD_Temperature,
        ];
    }
}
