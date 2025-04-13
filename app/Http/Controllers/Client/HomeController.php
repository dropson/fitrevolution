<?php

namespace App\Http\Controllers\Client;

use App\Enums\WorkoutScheduleStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Workouts\WorkoutSchedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::withWorkoutCounts()->find(Auth::id());
        $todayEvent = WorkoutSchedule::forUser($user->id)
            ->forToday()
            ->first();
        
        $tomorrowEvent = WorkoutSchedule::forUser($user->id)
            ->forTomorrow()
            ->first();
        return view('clients.home', compact('todayEvent', 'tomorrowEvent' ,'user'));
    }
}
