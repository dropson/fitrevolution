<?php

declare(strict_types=1);

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\General\BaseWorkoutTemplateController;
use Illuminate\Support\Facades\Auth;

final class WorkoutTemplateController extends BaseWorkoutTemplateController
{
    public function __construct()
    {
        parent::__construct('coaches');
    }

    public function index()
    {
        $user = Auth::user();

        $workouts = $user->workoutTemplatesAsCoach->load('exercises');

        return view('general.workout_templates.index', [
            'workouts' => $workouts,
            'routePrefix' => $this->routePrefix,
        ]);
    }
}
