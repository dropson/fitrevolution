<?php

declare(strict_types=1);

namespace App\Http\Requests\Workouts;

use App\Models\Workouts\WorkoutExercise;

final class UpdateWorkoutRequest extends BaseWorkoutRequest
{
    public function rules(): array
    {
        $rules = parent::rules();

        // Нове правило для exercise_id
        $rules['exercises.*.exercise_id'] = ['required', function ($attribute, $value, $fail): void {
            // Перевіряємо, чи це ID із workout_exercises (існуюча вправа)
            $existsInWorkoutExercises = WorkoutExercise::where('id', $value)->exists();
            if ($existsInWorkoutExercises) {
                return;
            }

            // Якщо це не ID із workout_exercises, перевіряємо, чи це ID із exercises (нова вправа)
            $existsInExercises = \App\Models\Exercise::where('id', $value)->exists();
            if (! $existsInExercises) {
                $fail('ID вправи має існувати в таблиці вправ або в таблиці проміжних вправ тренування.');
            }
        }];

        $rules['scheduled_date'] = ['nullable', 'date_format:Y-m-d'];

        return $rules;
    }

    protected function prepareForValidation(): void
    {
        $data = $this->all();

        if (isset($data['exercises'])) {
            foreach ($data['exercises'] as &$exercise) {
                // Для існуючих вправ (з workout_exercise_id)
                if (isset($exercise['workout_exercise_id'])) {
                    $exercise['exercise_id'] = $exercise['workout_exercise_id'];
                    unset($exercise['workout_exercise_id']);
                }
                // Для нових вправ (з id)
                elseif (isset($exercise['id'])) {
                    $exercise['exercise_id'] = $exercise['id'];
                    unset($exercise['id']);
                }
            }
            $this->replace($data);
        }
    }

    protected function getExerciseIdKey(): string
    {
        return 'workout_exercise_id';
    }
}
