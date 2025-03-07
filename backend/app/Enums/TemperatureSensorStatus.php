<?php

namespace App\Enums;

use App\Cores\BaseEnum;

class TemperatureSensorStatus extends BaseEnum
{
    public const HIGH_TEMPERATURE = 'high_temperature';
    public const LOW_TEMPERATURE = 'low_temperature';
    public const GOOD_TEMPERATURE = 'good_temperature';

    public static function all(): array
    {
        return [
            self::HIGH_TEMPERATURE,
            self::LOW_TEMPERATURE,
            self::GOOD_TEMPERATURE,
        ];
    }

    public static function labels($translate = true): array
    {
        return [
            self::HIGH_TEMPERATURE,
            self::LOW_TEMPERATURE,
            self::GOOD_TEMPERATURE,
        ];
    }
}
