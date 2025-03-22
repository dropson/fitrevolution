<?php

namespace App\Http\Controllers\Client;

use App\Enums\EquipmentEnum;
use App\Enums\MuscleGroupEnum;
use App\Filters\ExerciseFilter;
use App\Http\Controllers\Controller;
use App\Models\Exercise;
use Illuminate\Http\Request;
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

        $personalExercises = Exercise::query()
            ->forUser($user)
            ->get();

        return view("clients.exercises.index", [
            'publicExercises' => $publicExercises,
            'personalExercises' => $personalExercises,
            'muscleGroups' => MuscleGroupEnum::cases(),
            'equipments' => EquipmentEnum::cases(),
        ]);
    }

    public function create()
    {
        return view("clients.exercises.create", [
            'muscleGroups' => MuscleGroupEnum::cases(),
            'equipments' => EquipmentEnum::cases(),
        ]);
    }

    public function store(Request $request)
    {
        //  TODO
        //  policy, action or service , request
        $request->validate([
            'title' => ['required', 'string'],
            'muscle_group' => ['required', 'in:' . implode(',', MuscleGroupEnum::values())],
            'equipment' => ['required', 'in:' . implode(',', EquipmentEnum::values())],
            'instruction' => ['required', 'string'],
        ]);

        $user = Auth::user();
        $user->exercises()->create($request->all());

        return to_route('clients.exercises.index')->with('success', 'Exercise was created');

    }

    public function edit(Exercise $exercise)
    {
        $this->authorize('update', $exercise);

        return view('clients.exercises.edit', [
            'exercise' => $exercise,
            'muscleGroups' => MuscleGroupEnum::cases(),
            'equipments' => EquipmentEnum::cases(),
        ]);
    }
    public function update(Request $request, Exercise $exercise)
    {
        $this->authorize('update', $exercise);

        $request->validate([
            'title' => ['required', 'string'],
            'muscle_group' => ['required', 'in:' . implode(',', MuscleGroupEnum::values())],
            'equipment' => ['required', 'in:' . implode(',', EquipmentEnum::values())],
            'instruction' => ['required', 'string'],
        ]);
        $exercise->update($request->all());
        return to_route('clients.exercises.edit', $exercise)->with('success', 'Exercise was updated');
    }
    public function destroy(Exercise $exercise)
    {
        //  TODO
        //   another method ?
        $this->authorize('delete', $exercise);
        $exercise->delete();
        return to_route('clients.exercises.index')->with('success', 'Exercise was deleted');
    }
}
