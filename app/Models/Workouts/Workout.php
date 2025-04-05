<?php

namespace App\Models\Workouts;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Workout extends Model
{
    
    protected $fillable = [
        'title',
        'instruction',
        'order',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function schedules():HasMany
    {
        return $this->hasMany(WorkoutSchedule::class);
    }
}
