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

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected static function booted()
    {
        static::deleting(function ($user) {
            if ($user->clientProfile) {
                $user->clientProfile->delete();
            }

            if ($user->coachProfile) {
                $user->coachProfile->delete();
            }

            $user->coaches()->detach();
            $user->clientsAsCoach()->detach();

            $user->exercises()->delete();

            $user->workoutsAsClient()->each(function ($workout) {
                $workout->schedules()->delete();
                $workout->delete();
            });

            $user->workoutTemplatesForClient()->delete();

            TemplateWorkout::where('author_id', $user->id)->delete();
            $user->workoutSchedulesAsClient()->delete();
        });
    }

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
        return $this->belongsToMany(self::class, 'coach_clients', 'coach_id', 'client_id');
    }
    public function coaches(): BelongsToMany
    {
        return $this->belongsToMany(self::class, 'coach_clients', 'client_id', 'coach_id');
    }
    public function exercises(): HasMany
    {
        return $this->hasMany(Exercise::class, 'created_by');
    }

    public function workoutsAsClient(): HasMany
    {
        return $this->hasMany(Workout::class, 'client_id')->latest();
    }

    public function workoutTemplatesForClient()
    {
        return $this->hasMany(TemplateWorkout::class, 'client_id')->latest();
    }

    public function workoutTemplatesAsBase()
    {
        return $this->hasMany(TemplateWorkout::class, 'author_id')
            ->whereNull('client_id')
            ->latest();
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
