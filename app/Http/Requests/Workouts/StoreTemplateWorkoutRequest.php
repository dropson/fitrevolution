<?php

declare(strict_types=1);

namespace App\Http\Requests\Workouts;

final class StoreTemplateWorkoutRequest extends BaseWorkoutRequest
{
    public function rules(): array
    {
        $rules = parent::rules();

        $rules['exercises.*.exercise_id'] = ['required', 'integer', 'exists:exercises,id'];

        return $rules;
    }

    protected function getExerciseIdKey(): string
    {
        return 'id';
    }
}
