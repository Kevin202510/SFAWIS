<?php

namespace App\Enums;

use App\Cores\BaseEnum;

class SoilMoistureSensorStatus extends BaseEnum
{
    public const LONG_DROUGHT = "long_drought";
    public const MOISTURE_DEFICIT = "moisture_deficit";
    public const OPTIMAL_MOISTURE = "optimal_moisture";
    public const MOISTURE_EXCESS = "moisture_excess";

    public static function all(): array
    {
        return [
            self::LONG_DROUGHT,
            self::MOISTURE_DEFICIT,
            self::OPTIMAL_MOISTURE,
            self::MOISTURE_EXCESS,
        ];
    }
}
