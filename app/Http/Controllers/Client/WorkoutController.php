<?php

declare(strict_types=1);

namespace App\Http\Controllers\Client;

use App\Actions\Workouts\UpdateWorkoutAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Workouts\UpdateWorkoutRequest;
use App\Http\Resources\WorkoutResource;
use App\Models\Exercise;
use App\Models\Workouts\Workout;
use Illuminate\Support\Facades\Auth;

final class WorkoutController extends Controller
{
    public function editWorkout(Workout $workout)
    {
        $this->authorize('view', $workout);
        $workout = $workout->load([
            'schedule',
            'workoutExercises.exercise' => function ($query): void {
                $query->select('id', 'title', 'muscle_group');
            },
            'workoutExercises.sets' => function ($query): void {
                $query->select('workout_exercise_id', 'sets_number', 'repetitions', 'weight');
            },
        ]);
        $user = Auth::user();
        $exercises = Exercise::query()
            ->where(function ($query) use ($user): void {
                $query->whereNull('created_by')
                    ->orWhere('created_by', $user->id);
            })
            ->orderedForClient($user->id)
            ->latest()
            ->get();

        return view('clients.workouts.edit', [
            'workout' => $workout,
            'exercises' => $exercises->load('creator'),
        ]);
    }

    public function updateWorkout(UpdateWorkoutRequest $request, Workout $workout, UpdateWorkoutAction $action)
    {
        $this->authorize('update', $workout);
        $action->handle($request, $workout);

        return to_route('clients.calendar.index')->with('success', 'Workout was updated');
    }

    public function getWorkout(Workout $workout): WorkoutResource
    {
        $workout->load('workoutExercises.exercise', 'workoutExercises.sets');

        return new WorkoutResource($workout);
    }
}
