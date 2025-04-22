<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserGenderEnum;
use App\Enums\WorkoutScheduleStatusEnum;
use App\Models\Workouts\TemplateWorkout;
use App\Models\Workouts\Workout;
use App\Models\Workouts\WorkoutSchedule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

final class User extends Authenticatable
{
    use HasFactory, HasRoles, Notifiable;

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

    public static function withWorkoutCounts()
    {
        return self::withCount([
            'workoutSchedulesAsClient as workout_total_count',
            'workoutSchedulesAsClient as workout_completed_count' => function ($query): void {
                $query->where('status', WorkoutScheduleStatusEnum::Done->value);
            },
        ]);
    }

    public function clientProfile(): HasOne
    {
        return $this->hasOne(Client::class);
    }

    public function coachProfile(): HasOne
    {
        return $this->hasOne(Coach::class);
    }

    public function clientsAsCoach(): BelongsToMany
    {
        return $this->belongsToMany(self::class, 'coach_clients', 'coach_id', 'client_id')
            ->withTimestamps();
    }

    public function exercises(): HasMany
    {
        return $this->hasMany(Exercise::class, 'created_by');
    }

    public function workoutsAsClient(): HasMany
    {
        return $this->hasMany(Workout::class, 'client_id')->latest();
    }

    public function workoutTemplatesAsClient()
    {
        return $this->hasMany(TemplateWorkout::class, 'client_id')->latest();
    }

    public function workoutTemplatesAsCoach()
    {
        return $this->hasMany(TemplateWorkout::class, 'coach_id')->latest();
    }

    public function workoutSchedulesAsClient(): HasMany
    {
        return $this->hasMany(WorkoutSchedule::class, 'client_id');
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

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'gender' => UserGenderEnum::class,
        ];
    }
}
