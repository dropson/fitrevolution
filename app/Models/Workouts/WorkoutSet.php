<?php

namespace App\Models\Workouts;

use Illuminate\Database\Eloquent\Model;

class WorkoutSet extends Model
{
    protected $fillable = [
        'workout_exercise_id',
        'sets_number',
        'repetitions',
        'weight',
        'order',
    ];
}
