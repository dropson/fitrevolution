<?php

namespace App\Http\Requests\Client;

use App\Enums\EquipmentEnum;
use App\Enums\MuscleGroupEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpsertExerciseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:10', 'max:120'],
            'muscle_group' => ['required', Rule::enum(MuscleGroupEnum::class)],
            'equipment' => ['required', Rule::enum(EquipmentEnum::class)],
            'instruction' => ['required', 'string', 'min:10', 'max:500'],
        ];
    }
}
