<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Workouts\TemplateWorkout;

class TemplateWorkoutPolicy
{
    public function view(User $user, TemplateWorkout $templateWorkout): bool
    {
        return $user->id === $templateWorkout->user_id;
    }

    public function update(User $user, TemplateWorkout $templateWorkout): bool
    {
        return $user->id === $templateWorkout->user_id;
    }

    public function delete(User $user, TemplateWorkout $templateWorkout): bool
    {
        return $user->id === $templateWorkout->user_id;
    }
}
