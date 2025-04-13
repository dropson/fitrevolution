<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Workouts\TemplateWorkout;
use App\Models\Workouts\WorkoutSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\map;

class CalendarController extends Controller
{

    public function index()
    {
        return view('clients.calendar.index');
    }

    public function getSchedule()
    {
        $user = Auth::user();
        $schedules = $user->workoutSchedules->load('workout');

        $events = $schedules->map(function($schedule) {
            return [
                'id' => $schedule->id,
                'title' => $schedule->workout->title,
                'start' => $schedule->scheduled_date,
                'extendedProps' => [
                    'status' => $schedule->status->value,
                    'workout_id' => $schedule->workout_id,
                ],
            ];
        });
        return response()->json($events);
    }

    public function getWorkouts()
    {
        $workouts = TemplateWorkout::all();
        return response()->json($workouts);
    }
}
