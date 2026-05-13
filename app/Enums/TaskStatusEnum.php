<?php

namespace App\Enums;

enum TaskStatusEnum:string
{
    case PENDING = 'Pending';
    case COMPLETED = 'Completed';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}