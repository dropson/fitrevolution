<?php

declare(strict_types=1);

namespace App\Enums;

enum MuscleGroupEnum: string
{
    case Chest = 'Chest';
    case Triceps = 'Triceps';
    case Legs = 'Legs';
    case Back = 'Back';
    case Biceps = 'Biceps';
    case Shoulder = 'Shoulder';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
