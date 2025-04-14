<?php

declare(strict_types=1);

namespace App\Enums;

enum UserGenderEnum: string
{
    case Male = 'male';
    case Female = 'female';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function label(): string
    {
        return match ($this) {
            self::Male => 'Male',
            self::Female => 'Female',
        };
    }
}
