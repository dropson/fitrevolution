<?php

namespace App\Http\Controllers\Coach;

use App\Actions\Workouts\CreateTemplateWorkoutAction;
use App\Actions\Workouts\UpdateTemplateWorkoutAction;
use App\Http\Controllers\Controller;
use App\Http\Controllers\General\BaseWorkoutTemplateController;
use App\Http\Requests\Workouts\StoreTemplateWorkoutRequest;
use App\Http\Requests\Workouts\UpdateTemplateWorkoutRequest;
use App\Models\Exercise;
use App\Models\User;
use App\Models\Workouts\TemplateWorkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientWorkoutTemplatesController extends Controller
{

    public function index(User $client)
    {
        $user = Auth::user();
        $workouts = TemplateWorkout::where([['client_id', $client->id], ['coach_id', $user->id]])->latest()->get();
        $workouts->load('exercises');
        return view('coaches.clients.workout_templates.index', [
            'workouts' => $workouts,
            'client' => $client,
            'routePrefix' => 'coaches.clients',
            'routeParams' => ['client' => $client]
        ]);
    }
    public function createTemplate(User $client)
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

        return view('coaches.clients.workout_templates.create', [
            'exercises' => $exercises->load('creator'),
            'routePrefix' => 'coaches.clients',
            'client' => $client
        ]);
    }
    public function storeTemplate(StoreTemplateWorkoutRequest $request, User $client, CreateTemplateWorkoutAction $action)
    {
        $action->handle($request, null, $client);

        return to_route("coaches.clients.workout_templates.index", $client)->with('success', 'Workout was created');
    }
    public function editTemplate(User $client, TemplateWorkout $template)
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

        return view('coaches.clients.workout_templates.edit', [
            'workout' => $template,
            'routePrefix' => 'coaches.clients',
            'exercises' => $exercises->load('creator'),
            'client' => $client
        ]);
    }
    public function updateTemplate(UpdateTemplateWorkoutRequest $request,User $client, TemplateWorkout $template, UpdateTemplateWorkoutAction $action)
    {
        $this->authorize('update', $template);
        $action->handle($request, $template);

        return back()->with('success', 'Workout Tempate was updated');

    }

    public function destroyTemplate(User $client, TemplateWorkout $template)
    {
        $this->authorize('delete', $template);
        $template->delete();

        return back()->with('success', 'Workout was deleted');
    }
}
