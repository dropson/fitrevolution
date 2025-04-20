<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\EquipmentEnum;
use App\Enums\MuscleGroupEnum;
use App\Filters\QueryFilter;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

final class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'created_by',
        'muscle_group',
        'equipment',
        'instruction',
    ];

    protected $casts = [
        'muscle_group' => MuscleGroupEnum::class,
        'equipment' => EquipmentEnum::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeGeneral($query)
    {
        return $query->whereNull('created_by');
    }

    public function scopeForClient($query, int $clientId)
    {
        return $query->where('created_by', $clientId);
    }

    public function scopeOrderedForClient($query, int $clientId)
    {
        return $query
            ->select('exercises.*')
            ->orderByRaw('CASE WHEN created_by = ? THEN 0 ELSE 1 END', [$clientId]);
    }

    public function scopeFilter(Builder $builder, QueryFilter $filters): Builder
    {
        return $filters->apply($builder);
    }

    public function getShortInstructionAttribute(): string
    {
        return Str::limit($this->instruction, 118, ' ...');
    }

    public function getMuscleGroupIconAttribute(): string
    {
        $icons = [
            MuscleGroupEnum::Chest->value => 'images/muscle_groups/chest.png',
            MuscleGroupEnum::Triceps->value => 'images/muscle_groups/triceps.png',
            MuscleGroupEnum::Biceps->value => 'images/muscle_groups/biceps.png',
            MuscleGroupEnum::Shoulder->value => 'images/muscle_groups/shoulder.png',
            MuscleGroupEnum::Legs->value => 'images/muscle_groups/legs.png',
            MuscleGroupEnum::Back->value => 'images/muscle_groups/back.png',
        ];

        return $icons[$this->muscle_group->value] ?? 'images/muscle_groups/core.png';
    }
}
