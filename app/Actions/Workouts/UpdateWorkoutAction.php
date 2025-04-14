<?php

declare(strict_types=1);

namespace App\Actions\Workouts;

use App\Enums\WorkoutScheduleStatusEnum;
use App\Http\Requests\Client\UpdateWorkoutRequst;
use App\Models\Workouts\Workout;

final class UpdateWorkoutAction
{
    public function handle(UpdateWorkoutRequst $request, Workout $workout): void
    {
        $now = now()->toDateString();
        $eventDate = $workout->schedule->scheduled_date->toDateString();
        $data = $request->safe()->only('title', 'instruction');
        $scheduleDate = $request->safe()->only('scheduled_date');

        if ($now >= $eventDate) {
            $scheduleDate['status'] = WorkoutScheduleStatusEnum::Pending;
        }

        $workout->update($data);
        if ($scheduleDate) {
            $workout->schedule()->update($scheduleDate);
        }
    }
}
