<?php

namespace App\Models\Workouts;

use App\Enums\WorkoutScheduleStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkoutSchedule extends Model
{
    protected $fillable = [
        'user_id',
        'workout_id',
        'scheduled_date',
        'status',
        'complated_at'
    ];
    protected $casts = [
        'scheduled_date' => 'date',
        'status' => WorkoutScheduleStatusEnum::class
    ];
    public function getFormattedScheduledDateAttribute()
    {
        return $this->scheduled_date ? $this->scheduled_date->format('Y-m-d') : null;
    }
    public function workout():BelongsTo
    {
        return $this->belongsTo(Workout::class);
    }
}
