<?php

declare(strict_types=1);

namespace App\Models\Workouts;

use App\Models\Exercise;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class TemplateWorkoutExercise extends Model
{
    protected $fillable = [
        'template_workout_id',
        'exercise_id',
        'order',
    ];

    public function templateWorkout(): BelongsTo
    {
        return $this->belongsTo(TemplateWorkout::class);
    }

    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }

    public function templateSets()
    {
        return $this->hasMany(TemplateSet::class);
    }
}
