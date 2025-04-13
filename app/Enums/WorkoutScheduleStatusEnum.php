<?php

namespace App\Enums;

enum WorkoutScheduleStatusEnum: string
{
    case Pending = 'Pending';
    case Done = 'Done';
    case Skipped = 'Skipped';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

}
