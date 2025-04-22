<?php

declare(strict_types=1);

namespace App\Http\Requests\Workouts;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseWorkoutRequest extends FormRequest
{
    abstract protected function getExerciseIdKey(): string;

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $data = $this->all();

        if (isset($data['exercises'])) {
            foreach ($data['exercises'] as &$exercise) {
                $exerciseIdKey = $this->getExerciseIdKey();
                if (isset($exercise[$exerciseIdKey])) {
                    $exercise['exercise_id'] = $exercise[$exerciseIdKey];
                    unset($exercise[$exerciseIdKey]);
                }
            }
            $this->replace($data);
        }
    }

    protected function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:5', 'max:70'],
            'instruction' => ['nullable', 'string'],
            'exercises' => ['required', 'array'],
            'exercises.*.deleted' => ['sometimes', 'in:0,1'],
            'exercises.*.sets' => ['nullable', 'array'],
            'exercises.*.sets.*.id' => ['nullable', 'integer'],
            'exercises.*.sets.*.sets_number' => ['required', 'integer', 'min:1'],
            'exercises.*.sets.*.repetitions' => ['required', 'integer', 'min:1'],
            'exercises.*.sets.*.weight' => ['nullable', 'numeric'],
        ];
    }
}
