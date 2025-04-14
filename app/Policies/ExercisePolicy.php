<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Exercise;
use App\Models\User;

final class ExercisePolicy
{
    public function update(User $user, Exercise $exercise): bool
    {
        return $exercise->user_id === $user->id;
    }

    public function delete(User $user, Exercise $exercise): bool
    {
        return $exercise->user_id === $user->id;
    }
}
