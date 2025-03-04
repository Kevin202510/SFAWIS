<?php

namespace App\Enums;

use App\Cores\BaseEnum;

class NotificationStatus extends BaseEnum
{
    public const READ = 'read';
    public const UNREAD = 'unread';

    public static function all(): array
    {
        return [
            self::READ,
            self::UNREAD,
        ];
    }
}
