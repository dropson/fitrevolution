<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Workouts\Workout;
use App\Models\Workouts\WorkoutExercise;
use App\Models\Workouts\WorkoutSet;
use Exception;

final class WorkoutExerciseService
{
    public function addExerciseWithSets(Workout $templateWorkout, array $exerciseData, int $index): WorkoutExercise
    {

        $templateWorkout->exercises()->attach($exerciseData['id'], ['order' => $index]);

        $templateWorkoutExercise = $templateWorkout->workoutExercises()
            ->where('exercise_id', $exerciseData['id'])
            ->orderBy('id', 'desc')
            ->first();

        if (! $templateWorkoutExercise) {
            throw new Exception('Failed to create WorkoutExercise for exercise ID: '.$exerciseData['id']);
        }

        $this->createSets($templateWorkoutExercise, $exerciseData['sets'] ?? []);

        return $templateWorkoutExercise;
    }

    private function createSets(WorkoutExercise $templateWorkoutExercise, array $sets): void
    {
        foreach ($sets as $setIndex => $setData) {
            WorkoutSet::create([
                'workout_exercise_id' => $templateWorkoutExercise->id,
                'sets_number' => $setData['sets_number'],
                'repetitions' => $setData['repetitions'],
                'weight' => $setData['weight'],
                'order' => $setIndex,
            ]);
        }
    }
}
