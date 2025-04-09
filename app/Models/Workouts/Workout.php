<?php

namespace App\Models\Workouts;

use App\Models\Exercise;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Workout extends Model
{
    
    protected $fillable = [
        'title',
        'instruction',
        'order',
        'user_id',
        'template_workout_id'
    ];

    public function schedules():HasMany
    {
        return $this->hasMany(WorkoutSchedule::class);
    }
    public function exercises(): BelongsToMany
    {
        return $this->belongsToMany(Exercise::class, 'workout_exercises')
            ->withPivot('id', 'order');
    }

    public function workoutExercises(): HasMany
    {
        return $this->hasMany(WorkoutExercise::class);
    }
}
