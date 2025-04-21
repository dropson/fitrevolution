<?php

declare(strict_types=1);

namespace App\Http\Requests\Workouts;

use App\Models\Workouts\TemplateWorkoutExercise;

final class UpdateTemplateWorkoutRequest extends BaseWorkoutRequest
{
    public function rules(): array
    {
        $rules = parent::rules();

        // Додаємо правило для exercise_id
        $rules['exercises.*.exercise_id'] = ['required', function ($attribute, $value, $fail): void {
            // Перевіряємо, чи це ID із template_workout_exercises (існуюча вправа)
            $existsInTemplateWorkoutExercises = TemplateWorkoutExercise::where('id', $value)->exists();
            if ($existsInTemplateWorkoutExercises) {
                return;
            }

            // Якщо це не ID із template_workout_exercises, перевіряємо, чи це ID із exercises (нова вправа)
            $existsInExercises = \App\Models\Exercise::where('id', $value)->exists();
            if (! $existsInExercises) {
                $fail('ID вправи має існувати в таблиці вправ або в таблиці проміжних вправ шаблону.');
            }
        }];

        return $rules;
    }

    public function messages()
    {
        return [
            'exercises' => 'The exercises is required. ',
        ];
    }

    protected function prepareForValidation(): void
    {
        $data = $this->all();

        if (isset($data['exercises'])) {
            foreach ($data['exercises'] as &$exercise) {
                // Для існуючих вправ (з template_workout_exercise_id)
                if (isset($exercise['template_workout_exercise_id'])) {
                    $exercise['exercise_id'] = $exercise['template_workout_exercise_id'];
                    unset($exercise['template_workout_exercise_id']);
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
        return 'template_workout_exercise_id';
    }
}
