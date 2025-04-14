<?php

namespace App\Models\Workouts;

use Illuminate\Database\Eloquent\Model;

class TemplateSet extends Model
{
    protected $fillable = [
        'template_workout_exercise_id',
        'sets_number',
        'repetitions',
        'weight',
        'order',
    ];
}
