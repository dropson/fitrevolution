<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    public static function index()
    {
        $workouts = [1,2,3];

        return view('clients.workouts.index',[
            'workouts' => $workouts,
        ]);
    }
    public function create()
    {
        $exercises = Exercise::get();
        return view ('clients.workouts.create',[
            'exercises' => $exercises
        ]);
    }
}
