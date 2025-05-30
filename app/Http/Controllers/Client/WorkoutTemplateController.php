<?php

declare(strict_types=1);

namespace App\Http\Controllers\Client;

use App\Actions\Workouts\CreateTemplateWorkoutAction;
use App\Actions\Workouts\UpdateTemplateWorkoutAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Workouts\StoreTemplateWorkoutRequest;
use App\Http\Requests\Workouts\UpdateTemplateWorkoutRequest;
use App\Http\Resources\TemplateWorkoutReource;
use App\Models\Exercise;
use App\Models\Workouts\TemplateWorkout;
use Illuminate\Support\Facades\Auth;

final class WorkoutTemplateController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $workouts = $user->workoutTemplatesForClient()->where('is_visible_to_client', true)->get()->load('exercises');

        return view('clients.workout_templates.index', [
            'workouts' => $workouts,
            'routePrefix' => 'clients',
        ]);
    }

    public function createTemplate()
    {
        $user = Auth::user();
        $exercises = Exercise::query()
            ->where(function ($query) use ($user): void {
                $query->whereNull('created_by')
                    ->orWhere('created_by', $user->id);
            })
            ->orderedForClient($user->id)
            ->latest()
            ->get();

        return view('clients.workout_templates.create', [
            'exercises' => $exercises->load('creator'),
            'routePrefix' => 'clients',
        ]);
    }

    public function storeTemplate(StoreTemplateWorkoutRequest $request, CreateTemplateWorkoutAction $action)
    {
        $action->handle($request);

        return to_route('clients.workout_templates.index')->with('success', 'Workout Tempate  was created');
    }

    public function editTemplate(TemplateWorkout $template)
    {
        $template = $template->load([
            'templateWorkoutExercises.exercise' => function ($query): void {
                $query->select('id', 'title', 'muscle_group');
            },
            'templateWorkoutExercises.templateSets' => function ($query): void {
                $query->select('template_workout_exercise_id', 'sets_number', 'repetitions', 'weight');
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

        return view('clients.workout_templates.edit', [
            'workout' => $template,
            'exercises' => $exercises->load('creator'),
            'routePrefix' => 'clients',
        ]);
    }

    public function updateTemplate(UpdateTemplateWorkoutRequest $request, TemplateWorkout $template, UpdateTemplateWorkoutAction $action)
    {
        $this->authorize('update', $template);
        $action->handle($request, $template);

        return back()->with('success', 'Workout Tempate was updated');

    }

    public function destroyTemplate(TemplateWorkout $template)
    {
        $this->authorize('delete', $template);
        $template->delete();

        return back()->with('success', 'Workout template was deleted');
    }

    public function getTempateWorkout(TemplateWorkout $templateWorkout): TemplateWorkoutReource
    {
        $templateWorkout->load('templateWorkoutExercises.exercise', 'templateWorkoutExercises.templateSets');

        return new TemplateWorkoutReource($templateWorkout);
    }
}
