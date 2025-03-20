<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExerciseController extends Controller
{
    
    public function index()
    {
        $user = Auth::user();
        
        $publicExercises = Exercise::public()->get();

        return view("clients.exercises.index", compact("publicExercises"));
    
    }
}
