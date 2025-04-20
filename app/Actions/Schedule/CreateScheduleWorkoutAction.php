<?php

declare(strict_types=1);

namespace App\Actions\Schedule;

use App\Enums\WorkoutScheduleStatusEnum;
use App\Http\Requests\Client\StoreScheduleWorkoutRequest;
use App\Models\Workouts\TemplateWorkout;
use App\Models\Workouts\Workout;
use App\Models\Workouts\WorkoutSchedule;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

final class CreateScheduleWorkoutAction
{
    private const MAX_WORKOUTS_PER_DAY = 1;

    public function handle(StoreScheduleWorkoutRequest $request)
    {
        $user = Auth::user();
        $data = $request->validated();

        return DB::transaction(function () use ($data, $user) {

            $templateWorkout = TemplateWorkout::with('templateWorkoutExercises.exercise', 'templateWorkoutExercises.templateSets')
                ->findOrFail($data['template_workout_id']);

            $this->checkTemplateOwnership($user, $templateWorkout);

            $existingSchedulesCount = WorkoutSchedule::where('client_id', $templateWorkout->user_id)
                ->where('scheduled_date', $data['scheduled_date'])
                ->count();

            if ($existingSchedulesCount >= self::MAX_WORKOUTS_PER_DAY) {
                throw new Exception(
                    'You have reached the limit of '.self::MAX_WORKOUTS_PER_DAY.
                    " workouts on {$data['scheduled_date']}."
                );
            }

            $workout = Workout::create([
                'client_id' => $templateWorkout->client_id,
                'template_workout_id' => $templateWorkout->id,
                'title' => $templateWorkout->title,
                'instruction' => $templateWorkout->instruction,
            ]);
            if ($templateWorkout->templateWorkoutExercises->isNotEmpty()) {
                $exerciseData = [];
                $exerciseMapping = [];

                foreach ($templateWorkout->templateWorkoutExercises as $index => $templateExercise) {
                    $exerciseData[] = [
                        'workout_id' => $workout->id,
                        'exercise_id' => $templateExercise->exercise_id,
                        'order' => $templateExercise->order,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    $exerciseMapping[$templateExercise->id] = $index;
                }
                DB::table('workout_exercises')->insert($exerciseData);

                $newExercises = DB::table('workout_exercises')->where('workout_id', $workout->id)->orderBy('id')->get();
                $setsData = [];
                foreach ($templateWorkout->templateWorkoutExercises as $templateExercise) {

                    if ($templateExercise->templateSets->isNotEmpty()) {
                        $originalExeriseId = $templateExercise->id;
                        $newExerciseIndex = $exerciseMapping[$originalExeriseId];
                        $newExerciseId = $newExercises[$newExerciseIndex]->id;
                        foreach ($templateExercise->templateSets as $set) {
                            $setsData[] = [
                                'workout_exercise_id' => $newExerciseId,
                                'sets_number' => $set->sets_number,
                                'repetitions' => $set->repetitions,
                                'weight' => $set->weight,
                                'order' => $set->order,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ];
                        }
                    }
                }
                if ($setsData !== []) {
                    DB::table('workout_sets')->insert($setsData);
                }
            }

            return WorkoutSchedule::create([
                'client_id' => $workout->client_id,
                'workout_id' => $workout->id,
                'scheduled_date' => $data['scheduled_date'],
                'status' => WorkoutScheduleStatusEnum::Pending->value,
            ]);
        });
    }

    private function checkTemplateOwnership($user, TemplateWorkout $templateWorkout): void
    {
        if (! $templateWorkout->client_id || $templateWorkout->client_id !== $user->id) {
            throw new Exception('You can only schedule workouts using your own templates.');
        }
    }
}
