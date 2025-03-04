<?php

namespace App\Enums;

use App\Cores\BaseEnum;

class HumiditySensorStatus extends BaseEnum
{
    public const HIGH_HUMIDITY = 'high_humidity';
    public const LOW_HUMIDITY = 'low_humidity';
    public const GOOD_HUMIDITY = 'good_humidity';

    public static function all(): array
    {
        return [
            self::HIGH_HUMIDITY,
            self::LOW_HUMIDITY,
            self::GOOD_HUMIDITY,
        ];
    }
}
