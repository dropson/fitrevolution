<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Workouts\TemplateWorkout;
use Illuminate\Http\Request;

class CalendarController extends Controller
{

    public function index()
    {
        return view('clients.calendar.index');
    }

    public function getSchedule()
    {
        $data = [
            ['title' => 'my title', 'start' => '2025-04-05'],
            ['title' => 'my title2', 'start' => '2025-04-07']
        ];
        return response()->json($data);
    }

    public function getWorkouts()
    {
        $workouts = TemplateWorkout::all();
        return response()->json($workouts);
    }
}
