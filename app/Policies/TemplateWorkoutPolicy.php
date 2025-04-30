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
            return ($templateWorkout->author_id === $user->id) ||
                in_array($templateWorkout->client_id, $user->clientsAsCoach->pluck('id')->toArray());
        }

        if ($user->hasRole(UserRoleEnum::Client->value)) {
            return ($templateWorkout->author_id === $user->id) ||
                ($templateWorkout->client_id === $user->id && $templateWorkout->is_visible_to_client);
        }

        return false;
    }

    public function update(User $user, TemplateWorkout $templateWorkout): bool
    {
        if ($user->hasRole(UserRoleEnum::Coach->value)) {
            return ($templateWorkout->author_id === $user->id) ||
                in_array($templateWorkout->client_id, $user->clientsAsCoach->pluck('id')->toArray());
        }

        if ($user->hasRole(UserRoleEnum::Client->value)) {
            return ($templateWorkout->author_id === $user->id) ||
                ($templateWorkout->client_id === $user->id && $templateWorkout->is_editable_by_client);
        }

        return false;
    }

    public function delete(User $user, TemplateWorkout $templateWorkout): bool
    {
        return $this->update($user, $templateWorkout);
    }
}
