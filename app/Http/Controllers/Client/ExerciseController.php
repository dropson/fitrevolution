<?php

namespace App\Http\Controllers\Client;

use App\Enums\EquipmentEnum;
use App\Enums\MuscleGroupEnum;
use App\Filters\ExerciseFilter;
use App\Http\Controllers\Controller;
use App\Models\Exercise;
use Illuminate\Support\Facades\Auth;

class ExerciseController extends Controller
{

    public function index(ExerciseFilter $filters)
    {
        $user = Auth::user();
        $publicExercises = Exercise::query()
            ->public()
            ->filter($filters)
            ->get();
            
        return view("clients.exercises.index", [
            'publicExercises' => $publicExercises,
            'muscleGroups' => MuscleGroupEnum::cases(),
            'equipments' => EquipmentEnum::cases(),
        ]);
    }
}
