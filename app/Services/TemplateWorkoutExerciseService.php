<?php

namespace App\Services;

use App\Models\Workouts\TemplateSet;
use App\Models\Workouts\TemplateWorkout;
use App\Models\Workouts\TemplateWorkoutExercise;

class TemplateWorkoutExerciseService
{

    public function addExerciseWithSets(TemplateWorkout $templateWorkout, array $exerciseData, int $index): TemplateWorkoutExercise
    {

        $templateWorkout->exercises()->attach($exerciseData['id'], ['order' => $index]);

        $templateWorkoutExercise = $templateWorkout->templateWorkoutExercises()
            ->where('exercise_id', $exerciseData['id'])
            ->orderBy('id', 'desc')
            ->first();

        if (!$templateWorkoutExercise) {
            throw new \Exception('Failed to create TemplateWorkoutExercise for exercise ID: ' . $exerciseData['id']);
        }

        $this->createSets($templateWorkoutExercise, $exerciseData['sets'] ?? []);

        return $templateWorkoutExercise;
    }
    private function createSets(TemplateWorkoutExercise $templateWorkoutExercise, array $sets): void
    {
        foreach ($sets as $setIndex => $setData) {
            TemplateSet::create([
                'template_workout_exercise_id' => $templateWorkoutExercise->id,
                'sets_number' => $setData['sets_number'],
                'repetitions' => $setData['repetitions'],
                'weight' => $setData['weight'],
                'order' => $setIndex,
            ]);
        }
    }
}
