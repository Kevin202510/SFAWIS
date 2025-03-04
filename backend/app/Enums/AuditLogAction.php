<?php

namespace App\Enums;

use App\Cores\BaseEnum;

class AuditLogAction extends BaseEnum
{
    public const UPDATE = 'update';
    public const CREATE = 'create';
    public const CHANGE_STATUS = 'change_status';
    public const UPDATE_PROFILE = 'update_profile';
    public const DEACTIVATE = 'deactivate';
    public const ACTIVATE = 'active';    public const KICK = 'kick';

    public static function all(): array
    {
        return [
            self::UPDATE,
            self::CREATE,
            self::CHANGE_STATUS,
            self::UPDATE_PROFILE,
            self::DEACTIVATE,
            self::ACTIVATE,
        ];
    }

    public static function labels($translate = true): array
    {
        return [
            self::CHANGE_STATUS => 'Change Status',
            self::UPDATE => 'Update',
            self::CREATE => 'Create',
            self::UPDATE_PROFILE => 'Update Profile',
            self::DEACTIVATE => 'Deactivate',
            self::ACTIVATE => 'Activate'
        ];
    }
}
