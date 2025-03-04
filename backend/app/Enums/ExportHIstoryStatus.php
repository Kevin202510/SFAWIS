<?php

namespace App\Enums;

use App\Cores\BaseEnum;

class ExportHIstoryStatus extends BaseEnum
{
    public const DONE = 'done';
    public const FAILED = 'failed';

    public static function all(): array
    {
        return [
            self::DONE,
            self::FAILED,
        ];
    }
}
