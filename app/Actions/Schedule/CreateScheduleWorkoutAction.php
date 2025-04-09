<?php

namespace App\Actions\Schedule;

use App\Http\Requests\Client\StoreScheduleWorkoutRequst;
use App\Models\Workouts\TemplateWorkout;
use App\Models\Workouts\Workout;
use App\Models\Workouts\WorkoutSchedule;
use Exception;
use Illuminate\Support\Facades\DB;
class CreateScheduleWorkoutAction
{
    private const MAX_WORKOUTS_PER_DAY = 2;

    public function handle(StoreScheduleWorkoutRequst $request)
    {
        $data = $request->validated();
        return DB::transaction(function () use ($data) {

            $templateWorkout = TemplateWorkout::findOrFail($data['template_workout_id']);

            $existingSchedulesCount = WorkoutSchedule::where('user_id', $templateWorkout->user_id)
                ->where('scheduled_date', $data['scheduled_date'])
                ->count();

            if ($existingSchedulesCount >= self::MAX_WORKOUTS_PER_DAY) {
                throw new Exception("You have reached the limit of " . self::MAX_WORKOUTS_PER_DAY . " workouts on {$data['scheduled_date']}.");
            }

            $workout = Workout::where('template_workout_id', $templateWorkout->id)
                ->where('user_id', $templateWorkout->user_id)
                ->first();

            if (!$workout) {
                $workout = Workout::create([
                    'user_id' => $templateWorkout->user_id,
                    'template_workout_id' => $templateWorkout->id,
                    'title' => $templateWorkout->title,
                    'instruction' => $templateWorkout->instruction,
                ]);
            }

            $existingSchedule = WorkoutSchedule::where('workout_id', $workout->id)
                ->where('scheduled_date', $data['scheduled_date'])
                ->first();

            if ($existingSchedule) {
                throw new Exception("This workout is already scheduled on {$data['scheduled_date']}.");
            }
            $workoutSchedule = WorkoutSchedule::create([
                'user_id' => $workout->user_id,
                'workout_id' => $workout->id,
                'scheduled_date' => $data['scheduled_date'],
                'completed' => false,
            ]);

            return $workoutSchedule;
        });
    }
}
