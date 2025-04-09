<?php

namespace App\Http\Controllers\Client;

use App\Actions\Schedule\CreateScheduleWorkoutAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\StoreScheduleWorkoutRequst;
use Exception;
use Illuminate\Http\Request;

class ScheduleWorkoutController extends Controller
{
    public function schedule(StoreScheduleWorkoutRequst $request, CreateScheduleWorkoutAction $action)
    {
        try {
            $action->handle($request);
            return to_route('clients.workouts.index')
                ->with('success', 'Workout assigned successfully!');
        } catch (Exception $e) {
            return to_route('clients.workouts.index')
                ->with('error', $e->getMessage());
        }
    }
}
