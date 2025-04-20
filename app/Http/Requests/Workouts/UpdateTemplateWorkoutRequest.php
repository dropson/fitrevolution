<?php

declare(strict_types=1);

namespace App\Http\Requests\Workouts;

final class UpdateTemplateWorkoutRequest extends BaseWorkoutRequest
{
    public function rules(): array
    {
        $rules = parent::rules();
        $rules['exercises.*.exercise_id'] = ['nullable', 'exists:workout_exercises,id'];
        $rules['scheduled_date'] = ['nullable', 'date_format:Y-m-d'];

        return array_merge($rules, [
            'scheduled_date' => ['nullable', 'date_format:Y-m-d'],
        ]);
    }

    public function messages()
    {
        return [
            'exercises' => 'The exercises is required. ',
        ];
    }

    protected function getExerciseIdKey(): string
    {
        return 'workout_exercise_id';
    }
}
