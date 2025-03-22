<?php

namespace App\Policies;

use App\Models\Exercise;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ExercisePolicy
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
