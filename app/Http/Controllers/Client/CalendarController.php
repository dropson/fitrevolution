<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Workouts\TemplateWorkout;
use Illuminate\Support\Facades\Auth;

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

        $events = $schedules->map(fn($schedule): array => [
            'id' => $schedule->id,
            'title' => $schedule->workout->title,
            'start' => $schedule->scheduled_date,
            'extendedProps' => [
                'status' => $schedule->status->value,
                'workout_id' => $schedule->workout_id,
            ],
        ]);

        return response()->json($events);
    }

    public function getWorkouts()
    {
        $workouts = TemplateWorkout::all();

        return response()->json($workouts);
    }
}
