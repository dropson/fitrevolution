<?php

declare(strict_types=1);

namespace App\Http\Requests\Workouts;

final class UpdateWorkoutRequest extends BaseWorkoutRequest
{
    public function rules(): array
    {
        $reles = parent::rules();
        $rules['exercises.*.exercise_id'] = ['nullable', 'exists:template_workout_exercises,id'];

        return $reles;
    }

    protected function getExerciseIdKey(): string
    {
        return 'template_workout_exercise_id';
    }
}
