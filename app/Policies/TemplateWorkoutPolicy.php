<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use App\Models\Workouts\TemplateWorkout;

final class TemplateWorkoutPolicy
{
    public function view(User $user, TemplateWorkout $templateWorkout): bool
    {
        return $user->id === $templateWorkout->client_id;
    }

    public function update(User $user, TemplateWorkout $templateWorkout): bool
    {
        return $user->id === $templateWorkout->client_id;
    }

    public function delete(User $user, TemplateWorkout $templateWorkout): bool
    {
        return $user->id === $templateWorkout->client_id;
    }
}
