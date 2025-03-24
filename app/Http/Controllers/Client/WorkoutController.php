<?php

namespace App\Http\Controllers\Client;

use App\Filters\ExerciseFilter;
use App\Http\Controllers\Controller;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkoutController extends Controller
{
    public static function index()
    {
        $workouts = [1, 2, 3];

        return view('clients.workouts.index', [
            'workouts' => $workouts,
        ]);
    }
    public function create(ExerciseFilter $filters)
    {
        $user = Auth::user();
        $personalExercises = Exercise::query()
            ->forUser($user->id)
            ->filter($filters)
            ->latest()
            ->get();

        $publicExercises = Exercise::query()
            ->public()
            ->filter($filters)
            ->latest()
            ->get();

        $exercises = $personalExercises->concat($publicExercises);
        return view('clients.workouts.create', [
            'exercises' => $exercises
        ]);
    }
}
