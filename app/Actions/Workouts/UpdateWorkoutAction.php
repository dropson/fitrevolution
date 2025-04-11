<?php

namespace App\Actions\Workouts;

use App\Http\Requests\Client\UpdateWorkoutRequst;
use App\Models\Workouts\Workout;

class UpdateWorkoutAction
{
    public function handle(UpdateWorkoutRequst $request, Workout $workout)
    {
        $data = $request->safe()->only('title', 'instruction');
        $scheduleDate = $request->safe()->only('scheduled_date');

        $workout->update($data);

        if($scheduleDate) {
            $workout->schedule()->update($scheduleDate);
        }
    }
}
