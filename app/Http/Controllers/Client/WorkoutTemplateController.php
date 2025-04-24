<?php

declare(strict_types=1);

namespace App\Http\Controllers\Client;

use App\Http\Controllers\General\BaseWorkoutTemplateController;
use Illuminate\Support\Facades\Auth;

final class WorkoutTemplateController extends BaseWorkoutTemplateController
{
    public function __construct()
    {
        parent::__construct('clients');
    }

    public function index()
    {
        $user = Auth::user();

        $workouts = $user->workoutTemplatesAsClient->load('exercises');

        return view('general.workout_templates.index', [
            'workouts' => $workouts,
            'routePrefix' => $this->routePrefix,
        ]);
    }
}
