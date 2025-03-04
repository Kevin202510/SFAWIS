<?php

namespace App\Enums;

use App\Cores\BaseEnum;

class Activation extends BaseEnum
{
    public const INACTIVE = 0;
    public const ACTIVE = 1;

    public static function all(): array
    {
        return [
            self::INACTIVE,
            self::ACTIVE,
        ];
    }

    public static function labels($translate = true): array
    {
        return [
            self::INACTIVE => 'Inactive',
            self::ACTIVE => 'Active',
        ];
    }

    public static function isActive($key)
    {
        return $key == self::ACTIVE;
    }
}
