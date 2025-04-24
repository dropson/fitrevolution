<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use App\Models\Workouts\Workout;

final class WorkoutPolicy
{
    public function view(User $user, Workout $workout): bool
    {
        return $workout->client_id === $user->id;
    }

    public function update(User $user, Workout $workout): bool
    {
        return $this->view($user, $workout);
    }

    public function delete(User $user, Workout $workout): bool
    {
        return $this->view($user, $workout);
    }
}
