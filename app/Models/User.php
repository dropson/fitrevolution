<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserGenderEnum;
use App\Enums\WorkoutScheduleStatusEnum;
use App\Models\Workouts\TemplateWorkout;
use App\Models\Workouts\Workout;
use App\Models\Workouts\WorkoutSchedule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'gender' => UserGenderEnum::class,
        ];
    }

    public function exercises(): HasMany
    {
        return $this->hasMany(Exercise::class);
    }

    public function workouts(): HasMany
    {
        return $this->hasMany(Workout::class)->latest();
    }

    public function templateWorkouts(): HasMany
    {
        return $this->hasMany(TemplateWorkout::class)->latest();
    }
    public function workoutSchedules(): HasMany
    {
        return $this->hasMany(WorkoutSchedule::class);
    }   
    public static function withWorkoutCounts()
    {
        return static::withCount([
            'workoutSchedules as workout_total_count',
            'workoutSchedules as workout_completed_count' => function ($query) {
                $query->where('status', WorkoutScheduleStatusEnum::Done->value);
            },
        ]);
    } 
    public function getWorkoutCompletedCountAttribute()
    {
        return $this->attributes['workout_completed_count'] ?? $this->workoutSchedules()
            ->where('status', WorkoutScheduleStatusEnum::Done->value)
            ->count();
    }

    public function getWorkoutTotalCountAttribute()
    {
        return $this->attributes['workout_total_count'] ?? $this->workoutSchedules()->count();
    }
}
