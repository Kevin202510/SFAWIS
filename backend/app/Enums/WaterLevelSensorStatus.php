<?php

namespace App\Enums;

use App\Cores\BaseEnum;

class WaterLevelSensorStatus extends BaseEnum
{
    public const HIGH_WATER_LEVEL = 'high_water_level';
    public const LOW_WATER_LEVEL = 'low_water_level';
    public const GOOD_WATER_LEVEL = 'good_water_level';

    public static function all(): array
    {
        return [
            self::HIGH_WATER_LEVEL,
            self::LOW_WATER_LEVEL,
            self::GOOD_WATER_LEVEL,
        ];
    }
}
