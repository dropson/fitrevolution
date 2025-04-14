<?php

namespace App\Filters;

class ExerciseFilter extends QueryFilter
{
    protected $filterable = [
        'equipment',
        'muscle_group' => 'muscleGroup',
        'title',
    ];

    public function title($value)
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
