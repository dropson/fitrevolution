<?php

declare(strict_types=1);

namespace App\Actions\Workouts;

use App\Models\Workouts\TemplateSet;
use App\Models\Workouts\TemplateWorkout;
use App\Models\Workouts\TemplateWorkoutExercise;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

final class UpdateTemplateWorkoutAction extends BaseWorkoutAction
{
    public function handle(FormRequest $request, ?Model $model = null): Model
    {
        $data = $request->validated();
        return DB::transaction(function () use ($model, $data): ?Model {
            $model->update([
                'title' => $data['title'],
                'instruction' => $data['instruction'] ?? null,
                "is_visible_to_client" => $data['is_visible_to_client'],
                "is_editable_by_client" => $data['is_editable_by_client']
            ]);
            $this->processExercises($model, $data);

            return $model;
        });
    }

    protected function getWorkoutExerciseModel(): string
    {
        return TemplateWorkoutExercise::class;
    }

    protected function getSetModel(): string
    {
        return TemplateSet::class;
    }

    protected function getWorkoutModel(): string
    {
        return TemplateWorkout::class;
    }
}
