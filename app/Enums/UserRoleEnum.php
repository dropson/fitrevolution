<?php

declare(strict_types=1);

namespace App\Enums;

enum UserRoleEnum: string
{
    case Admin = 'admin';
    case Moderator = 'moderator';
    case Coach = 'coach';
    case Client = 'client';

}
