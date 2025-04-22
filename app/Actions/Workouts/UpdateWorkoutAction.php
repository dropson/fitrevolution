<?php

declare(strict_types=1);

namespace App\Actions\Workouts;

use App\Enums\WorkoutScheduleStatusEnum;
use App\Models\Workouts\Workout;
use App\Models\Workouts\WorkoutExercise;
use App\Models\Workouts\WorkoutSet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

final class UpdateWorkoutAction extends BaseWorkoutAction
{
    public function handle(FormRequest $request, ?Model $workout = null): Model
    {
        return DB::transaction(function () use ($request, $workout): Workout {
            $now = now()->toDateString();
            $eventDate = $workout->schedule->scheduled_date->toDateString();
            $data = $request->validated();
            $workoutData = $request->safe()->only('title', 'instruction');
            $scheduleData = $request->safe()->only('scheduled_date');
            if ($now >= $eventDate) {
                $scheduleData['status'] = WorkoutScheduleStatusEnum::Pending;
            }

            $workout->update($workoutData);
            if ($scheduleData) {
                $workout->schedule()->update($scheduleData);
            }
            $this->processExercises($workout, $data);

            return $workout;
        });
    }

    protected function getWorkoutExerciseModel(): string
    {
        return WorkoutExercise::class;
    }

    protected function getSetModel(): string
    {
        return WorkoutSet::class;
    }

    protected function getWorkoutModel(): string
    {
        return Workout::class;
    }
}
