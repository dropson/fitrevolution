<?php

declare(strict_types=1);

namespace App\Actions\Workouts;

use App\Http\Requests\Workouts\UpdateTemplateWorkoutRequest;
use App\Models\Workouts\TemplateSet;
use App\Models\Workouts\TemplateWorkout;
use App\Models\Workouts\TemplateWorkoutExercise;
use App\Services\TemplateWorkoutExerciseService;
use Illuminate\Support\Facades\DB;

final readonly class UpdateTemplateWorkoutAction
{
    public function __construct(private TemplateWorkoutExerciseService $exerciseService) {}

    public function handle(UpdateTemplateWorkoutRequest $request, TemplateWorkout $templateWorkout): TemplateWorkout
    {
        $data = $request->validated();
        DB::transaction(function () use ($data, $templateWorkout): TemplateWorkout {

            $templateWorkout->update([
                'title' => $data['title'],
                'instruction' => $data['instruction'],
            ]);

            $this->processExercises($templateWorkout, $data);

            return $templateWorkout;
        });

        return $templateWorkout;
    }

    private function processExercises(TemplateWorkout $templateWorkout, array $data): void
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

            TemplateSet::where('template_workout_exercise_id', $templateWorkoutExercise->id)
                ->whereNotIn('id', $remainingSetIds)
                ->delete();
        }
        TemplateWorkoutExercise::where('template_workout_id', $templateWorkout->id)
            ->whereNotIn('id', $remainingTemplateWorkoutExerciseIds)
            ->delete();
    }

    private function deleteExercise(array $exerciseData): void
    {
        if (! isset($exerciseData['template_workout_exercise_id'])) {
            return;
        }
        $templateWorkoutExercise = TemplateWorkoutExercise::findOrFail($exerciseData['template_workout_exercise_id']);
        $templateWorkoutExercise->templateSets()->delete();
        $templateWorkoutExercise->delete();
    }

    private function getOrCreateTemplateWorkoutExercise(TemplateWorkout $templateWorkout, array $exerciseData, int $index): TemplateWorkoutExercise
    {
        if (isset($exerciseData['template_workout_exercise_id'])) {
            return TemplateWorkoutExercise::findOrFail($exerciseData['template_workout_exercise_id']);
        }

        return $this->exerciseService->addExerciseWithSets($templateWorkout, $exerciseData, $index);
    }

    private function updateOrCreateSets(TemplateWorkoutExercise $templateWorkoutExercise, array $sets): array
    {
        $remainingSetIds = [];

        foreach ($sets as $setIndex => $setData) {
            if (isset($setData['id'])) {
                // Оновлюємо існуючий підхід
                $set = TemplateSet::find($setData['id']);
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
                $set = TemplateSet::create([
                    'template_workout_exercise_id' => $templateWorkoutExercise->id,
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
