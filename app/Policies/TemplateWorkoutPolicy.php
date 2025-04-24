<?php

declare(strict_types=1);

namespace App\Policies;

use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Models\Workouts\TemplateWorkout;

final class TemplateWorkoutPolicy
{
    public function view(User $user, TemplateWorkout $templateWorkout): bool
    {
        if ($user->hasRole(UserRoleEnum::Coach->value)) {
            return $templateWorkout->coach_id === $user->id;
        }

        if ($user->hasRole(UserRoleEnum::Client->value)) {
            return $templateWorkout->client_id === $user->id;
        }

        return false;
    }

    public function update(User $user, TemplateWorkout $templateWorkout): bool
    {
        return $this->view($user, $templateWorkout);
    }

    public function delete(User $user, TemplateWorkout $templateWorkout): bool
    {
        return $this->view($user, $templateWorkout);
    }
}
