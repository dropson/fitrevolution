<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use App\Models\Workouts\WorkoutSchedule;

final class WorkoutSchedulePolicy
{
    public function delete(User $user, WorkoutSchedule $workoutSchedule): bool
    {
        return $user->id === $workoutSchedule->user_id;
    }
}
