<?php

declare(strict_types=1);

namespace App\Http\Controllers\Client;

use App\Filters\ExerciseFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\UpsertExerciseRequest;
use App\Models\Exercise;
use Illuminate\Support\Facades\Auth;

final class ExerciseController extends Controller
{
    public function index(ExerciseFilter $filters)
    {
        $user = Auth::user();
        $publicExercises = Exercise::query()
            ->general()
            ->filter($filters)
            ->latest()
            ->get();
        $personalExercises = Exercise::query()
            ->forClient($user->id)
            ->latest()
            ->get();

        return view('clients.exercises.index', [
            'publicExercises' => $publicExercises->load('creator'),
            'personalExercises' => $personalExercises->load('creator'),
        ]);
    }

    public function create()
    {
        return view('clients.exercises.create');
    }

    public function store(UpsertExerciseRequest $request)
    {
        $user = Auth::user();
        $user->exercises()->create($request->validated());

        return to_route('clients.exercises.index')->with('success', 'Exercise was created');

    }

    public function edit(Exercise $exercise)
    {
        $this->authorize('update', $exercise);

        return view('clients.exercises.edit', [
            'exercise' => $exercise,
        ]);
    }

    public function update(UpsertExerciseRequest $request, Exercise $exercise)
    {
        $this->authorize('update', $exercise);
        $exercise->update($request->validated());

        return to_route('clients.exercises.index')->with('success', 'Exercise was updated');
    }

    public function destroy(Exercise $exercise)
    {
        $this->authorize('delete', $exercise);
        $exercise->delete();

        return to_route('clients.exercises.index')->with('success', 'Exercise was deleted');
    }
}
