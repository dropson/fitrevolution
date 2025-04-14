<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use App\Models\Workouts\WorkoutSchedule;

final class WorkoutSchedulePolicy
{
    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, WorkoutSchedule $workoutSchedule): bool
    {
        return false;
    }

    public function delete(User $user, WorkoutSchedule $workoutSchedule): bool
    {
        return $user->id === $workoutSchedule->user_id;
    }
}
