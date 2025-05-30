<?php

declare(strict_types=1);

namespace App\Filters;

final class ExerciseFilter extends QueryFilter
{
    protected $filterable = [
        'equipment',
        'muscle_group' => 'muscleGroup',
        'title' => 'title',
    ];

    public function title(string $value)
    {
        $likeStr = '%'.$value.'%';

        return $this->builder->where('title', 'like', $likeStr);
    }

    public function muscleGroup($value)
    {
        return $this->builder->where('muscle_group', $value);
    }

    public function equipment($value)
    {
        return $this->builder->where('equipment', $value);
    }
}
