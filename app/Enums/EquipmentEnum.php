<?php

declare(strict_types=1);

namespace App\Enums;

enum EquipmentEnum: string
{
    case None = 'None';
    case Barbell = 'Barbell';
    case Dumbbells = 'Dumbbells';
    case Kettlebell = 'Kettlebell';
    case Machine = 'Machine';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
