<?php

declare(strict_types=1);

namespace App\Actions\Workouts;

use App\Enums\WorkoutScheduleStatusEnum;
use App\Http\Requests\Workouts\UpdateWorkoutRequest;
use App\Models\Workouts\Workout;
use App\Models\Workouts\WorkoutExercise;
use App\Models\Workouts\WorkoutSet;
use App\Services\WorkoutExerciseService;
use Illuminate\Support\Facades\DB;

final readonly class UpdateWorkoutAction
{
    public function __construct(private WorkoutExerciseService $exerciseService) {}

    public function handle(UpdateWorkoutRequest $request, Workout $workout): void
    {
        DB::transaction(function () use ($request, $workout): Workout {

            $now = now()->toDateString();
            $eventDate = $workout->schedule->scheduled_date->toDateString();
            $data = $request->validated();
            $workoutData = $request->safe()->only('title', 'instruction');
            $scheduleDate = $request->safe()->only('scheduled_date');

            if ($now >= $eventDate) {
                $scheduleDate['status'] = WorkoutScheduleStatusEnum::Pending;
            }

            $workout->update($workoutData);
            if ($scheduleDate) {
                $workout->schedule()->update($scheduleDate);
            }
            $this->processExercises($workout, $data);

            return $workout;
        });
    }

    private function processExercises(Workout $templateWorkout, array $data): void
    {
        $remainingTemplateWorkoutExerciseIds = [];

        if (! isset($data['exercises'])) {
            return;
        }
        foreach ($data['exercises'] as $index => $exerciseData) {
            if ($exerciseData['deleted'] === '1') {
                $this->deleteExercise($exerciseData);

                continue;
            }

            $templateWorkoutExercise = $this->getOrCreateTemplateWorkoutExercise($templateWorkout, $exerciseData, $index);

            $remainingTemplateWorkoutExerciseIds[] = $templateWorkoutExercise->id;

            $remainingSetIds = $this->updateOrCreateSets($templateWorkoutExercise, $exerciseData['sets'] ?? []);

            WorkoutSet::where('workout_exercise_id', $templateWorkoutExercise->id)
                ->whereNotIn('id', $remainingSetIds)
                ->delete();
        }
        WorkoutExercise::where('workout_id', $templateWorkout->id)
            ->whereNotIn('id', $remainingTemplateWorkoutExerciseIds)
            ->delete();
    }

    private function deleteExercise(array $exerciseData): void
    {
        if (! isset($exerciseData['workout_exercise_id'])) {
            return;
        }
        $templateWorkoutExercise = Workout::findOrFail($exerciseData['workout_exercise_id']);
        $templateWorkoutExercise->templateSets()->delete();
        $templateWorkoutExercise->delete();
    }

    private function getOrCreateTemplateWorkoutExercise(Workout $templateWorkout, array $exerciseData, int $index): WorkoutExercise
    {
        if (isset($exerciseData['workout_exercise_id'])) {
            return WorkoutExercise::findOrFail($exerciseData['workout_exercise_id']);
        }

        return $this->exerciseService->addExerciseWithSets($templateWorkout, $exerciseData, $index);
    }

    private function updateOrCreateSets(WorkoutExercise $templateWorkoutExercise, array $sets): array
    {
        $remainingSetIds = [];

        foreach ($sets as $setIndex => $setData) {
            if (isset($setData['id'])) {
                // Оновлюємо існуючий підхід
                $set = WorkoutSet::find($setData['id']);
                if ($set) {
                    $set->update([
                        'sets_number' => $setData['sets_number'],
                        'repetitions' => $setData['repetitions'],
                        'weight' => $setData['weight'],
                        'order' => $setIndex,
                    ]);
                    $remainingSetIds[] = $set->id;
                }
            } else {
                // Створюємо новий підхід
                $set = WorkoutSet::create([
                    'workout_exercise_id' => $templateWorkoutExercise->id,
                    'sets_number' => $setData['sets_number'],
                    'repetitions' => $setData['repetitions'],
                    'weight' => $setData['weight'],
                    'order' => $setIndex,
                ]);
                $remainingSetIds[] = $set->id;
            }
        }

        return $remainingSetIds;
    }
}
