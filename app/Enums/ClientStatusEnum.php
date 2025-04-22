<?php

declare(strict_types=1);

namespace App\Enums;

enum ClientStatusEnum: string
{
    case Active = 'Active';
    case Paused = 'Paused';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
