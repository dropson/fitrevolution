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

final class CreateTemplateWorkoutAction extends BaseWorkoutAction
{
    public function handle(FormRequest $request, ?Model $model = null): Model
    {
        $data = $request->validated();
        $data['client_id'] = Auth::id();

        return DB::transaction(function () use ($data) {
            $templateWorkout = TemplateWorkout::create($data);
            $this->processExercises($templateWorkout, $data);

            return $templateWorkout;
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
