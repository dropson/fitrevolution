<?php

namespace App\Http\Controllers\Client;

use App\Actions\Schedule\CreateScheduleWorkoutAction;
use App\Enums\WorkoutScheduleStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\StoreScheduleWorkoutRequst;
use App\Models\Workouts\WorkoutSchedule;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ScheduleWorkoutController extends Controller
{
    public function storeSchedule(StoreScheduleWorkoutRequst $request, CreateScheduleWorkoutAction $action): RedirectResponse
    {
        try {
            $action->handle($request);
            return to_route('clients.workout_templates.index')
                ->with('success', 'Workout assigned successfully!');
        } catch (Exception $e) {
            return to_route('clients.workout_templates.index')
                ->with('error', $e->getMessage());
        }
    }

    public function markAsDone(Request $request, WorkoutSchedule $schedule): JsonResponse|RedirectResponse
    {
        $now = now()->toDateString();
        $eventDate = $schedule->scheduled_date->toDateString();
        if ($eventDate > $now) {
            return response()->json(['message' => 'Cannot mark future workouts as done']);
        }
        $schedule->update(['status' => WorkoutScheduleStatusEnum::Done->value]);
        if ($request->has('home_page')) {
            return to_route('clients.home')->with('success', 'Workout marked as done');
        }
        
        return response()->json(['message' => 'Workout marked as done']);

    }
    public function markAsSkipped(Request $request, WorkoutSchedule $schedule): JsonResponse|RedirectResponse
    {
        $now = now()->toDateString();
        $eventDate = $schedule->scheduled_date->toDateString();
        if ($eventDate > $now) {
            return response()->json(['message' => 'Cannot mark future workouts as skipped']);
        }
        $schedule->update(['status' => WorkoutScheduleStatusEnum::Skipped->value]);
        if ($request->has('home_page')) {
            return to_route('clients.home')->with('success', 'Workout marked as skipped');
        }
        return response()->json(['message' => 'Workout marked as done']);

    }

    public function destroySchedule(Request $request, WorkoutSchedule $schedule): JsonResponse|RedirectResponse
    {
        $this->authorize('delete', $schedule);
        $schedule->workout()->delete();
        $schedule->delete();
        if ($request->has('home_page')) {
            return to_route('clients.home')->with('success', 'Workout was deleted from schedule');
        }
        return response()->json(['message' => 'Workout was deleted from schedule']);
    }

}
