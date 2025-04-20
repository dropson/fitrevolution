<?php

declare(strict_types=1);

namespace App\Http\Requests\Workouts;

final class StoreTemplateWorkoutRequest extends BaseWorkoutRequest
{
    public function rules()
    {
        $rules = parent::rules();
        unset($rules['exercises.*.exercise_id']);

        return $rules;
    }

    protected function getExerciseIdKey(): string
    {
        return 'template_workout_exercise_id';
    }
}
