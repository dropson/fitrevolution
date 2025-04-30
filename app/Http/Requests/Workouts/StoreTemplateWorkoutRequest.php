<?php

declare(strict_types=1);

namespace App\Http\Requests\Workouts;

final class StoreTemplateWorkoutRequest extends BaseWorkoutRequest
{
    public function rules(): array
    {
        $rules = parent::rules();

        $rules['exercises.*.exercise_id'] = ['required', 'integer', 'exists:exercises,id'];
        $isClientTemplateWorkoutController = $this->routeIs('coaches.clients.workout_templates.store');
        if($isClientTemplateWorkoutController ){
            $rules['is_visible_to_client'] = ['required', 'boolean'];
            $rules['is_editable_by_client'] = ['required', 'boolean'];
        }
        return $rules;
    }

    protected function getExerciseIdKey(): string
    {
        return 'id';
    }
}
