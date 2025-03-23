<?php

namespace App\Http\Requests\Client;

use App\Enums\EquipmentEnum;
use App\Enums\MuscleGroupEnum;
use Illuminate\Foundation\Http\FormRequest;

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
            'muscle_group' => ['required', 'in:' . implode(',', MuscleGroupEnum::values())],
            'equipment' => ['required', 'in:' . implode(',', EquipmentEnum::values())],
            'instruction' => ['required', 'string', 'min:10', 'max:500'],
        ];
    }
}
