<?php

namespace App\Models\Workouts;

use App\Enums\WorkoutScheduleStatusEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkoutSchedule extends Model
{
    protected $fillable = [
        'user_id',
        'workout_id',
        'scheduled_date',
        'status',
        'complated_at',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
        'status' => WorkoutScheduleStatusEnum::class,
    ];

    public function scopeForDate($query, Carbon $date)
    {
        return $query->whereDate('scheduled_date', $date);
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeForToday($query)
    {
        return $query->forDate(Carbon::today());
    }

    public function scopeForTomorrow($query)
    {
        return $query->forDate(Carbon::tomorrow());
    }

    public function getFormattedScheduledDateAttribute()
    {
        return $this->scheduled_date ? $this->scheduled_date->format('Y-m-d') : null;
    }

    public function workout(): BelongsTo
    {
        return $this->belongsTo(Workout::class);
    }
}
