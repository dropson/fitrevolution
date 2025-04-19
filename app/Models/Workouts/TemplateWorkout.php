<?php

declare(strict_types=1);

namespace App\Models\Workouts;

use App\Models\Exercise;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class TemplateWorkout extends Model
{
    protected $fillable = [
        'title',
        'instruction',
        'order',
        'client_id',
        'coach_id',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function coach(): BelongsTo
    {
        return $this->belongsTo(User::class, 'coach_id');
    }

    public function exercises(): BelongsToMany
    {
        return $this->belongsToMany(Exercise::class, 'template_workout_exercises')
            ->withPivot('id', 'order');
    }

    public function templateWorkoutExercises(): HasMany
    {
        return $this->hasMany(TemplateWorkoutExercise::class);
    }

    public function getMuscleGroupsAttribute()
    {
        $exercises = $this->exercises;

        return $exercises->pluck('muscle_group')->map(fn ($muscleGroup) => $muscleGroup->value)->unique()->values();
    }
}
