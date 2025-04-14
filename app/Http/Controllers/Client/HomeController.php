<?php

declare(strict_types=1);

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Workouts\WorkoutSchedule;
use Illuminate\Support\Facades\Auth;

final class HomeController extends Controller
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

        return view('clients.home', ['todayEvent' => $todayEvent, 'tomorrowEvent' => $tomorrowEvent, 'user' => $user]);
    }
}
