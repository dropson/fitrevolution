<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTempaleteWorkoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:5', 'max:70'],
            'instruction' => ['nullable', 'string'],
            'exercises' => ['required', 'array'],
            'exercises.*.id' => ['integer', 'exists:exercises,id'],
            'exercises.*.template_workout_exercise_id' => 'nullable|exists:template_workout_exercises,id',
            'exercises.*.deleted' => 'in:0,1',
            'exercises.*.sets.*.sets_number' => ['integer', 'min:1'],
            'exercises.*.sets.*.repetitions' => ['integer', 'min:1'],
            'exercises.*.sets.*.weight' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [
            'exercises' => 'The exercises is required. ',
        ];
    }
}
