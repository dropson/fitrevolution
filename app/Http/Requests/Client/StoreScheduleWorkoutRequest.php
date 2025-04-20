<?php

declare(strict_types=1);

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

final class StoreScheduleWorkoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'template_workout_id' => 'required|exists:template_workouts,id',
            'scheduled_date' => 'required|date_format:Y-m-d',
        ];
    }
}
