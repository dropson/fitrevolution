<?php

namespace App\Models\Workouts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkoutSchedule extends Model
{
    protected $fillable = [
        'user_id',
        'workout_id',
        'scheduled_date',
        'completed',
        'complated_at'
    ];
    protected $casts = [
        'scheduled_date' => 'date',
        'completed' => 'boolean'
    ];

    public function workout():BelongsTo
    {
        return $this->belongsTo(Workout::class);
    }
}
