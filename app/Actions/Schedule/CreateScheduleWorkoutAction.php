<?php

namespace App\Actions\Schedule;

use App\Enums\WorkoutScheduleStatusEnum;
use App\Http\Requests\Client\StoreScheduleWorkoutRequst;
use App\Models\Workouts\TemplateWorkout;
use App\Models\Workouts\Workout;
use App\Models\Workouts\WorkoutSchedule;
use Exception;
use Illuminate\Support\Facades\DB;

class CreateScheduleWorkoutAction
{
    private const MAX_WORKOUTS_PER_DAY = 1;

    public function handle(StoreScheduleWorkoutRequst $request)
    {
        $data = $request->validated();

        return DB::transaction(function () use ($data) {

            $templateWorkout = TemplateWorkout::findOrFail($data['template_workout_id']);

            $existingSchedulesCount = WorkoutSchedule::where('user_id', $templateWorkout->user_id)
                ->where('scheduled_date', $data['scheduled_date'])
                ->count();

            if ($existingSchedulesCount >= self::MAX_WORKOUTS_PER_DAY) {
                throw new Exception(
                    'You have reached the limit of '.self::MAX_WORKOUTS_PER_DAY.
                    " workouts on {$data['scheduled_date']}."
                );
            }

            $workout = Workout::create([
                'user_id' => $templateWorkout->user_id,
                'template_workout_id' => $templateWorkout->id,
                'title' => $templateWorkout->title,
                'instruction' => $templateWorkout->instruction,
            ]);
            // TODO Exercises and sets

            $workoutSchedule = WorkoutSchedule::create([
                'user_id' => $workout->user_id,
                'workout_id' => $workout->id,
                'scheduled_date' => $data['scheduled_date'],
                'status' => WorkoutScheduleStatusEnum::Pending->value,
            ]);

            return $workoutSchedule;
        });
    }
}
