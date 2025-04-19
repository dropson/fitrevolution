<?php

declare(strict_types=1);

namespace App\Http\Controllers\Client;

use App\Actions\Workouts\UpdateWorkoutAction;
use App\Filters\ExerciseFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\UpdateWorkoutRequst;
use App\Http\Resources\WorkoutResource;
use App\Models\Exercise;
use App\Models\Workouts\Workout;
use Illuminate\Support\Facades\Auth;

final class WorkoutController extends Controller
{
    public function editWorkout(Workout $workout, ExerciseFilter $filters)
    {
        $this->authorize('view', $workout);
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
            'workout' => $workout->load('schedule'),
            'exercises' => $exercises->load('creator'),
        ]);
    }

    public function updateWorkout(UpdateWorkoutRequst $request, Workout $workout, UpdateWorkoutAction $action)
    {
        $this->authorize('update', $workout);
        $action->handle($request, $workout);

        return to_route('clients.calendar.index')->with('success', 'Workout was updated');
    }

    public function getWorkout(Workout $workout): WorkoutResource
    {
        return new WorkoutResource($workout);
    }
}
