<?php

declare(strict_types=1);

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter
{
    public $builder;

    protected $filterable = [];

    public function __construct(protected Request $request) {}

    final public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;
        foreach ($this->request->all() as $key => $value) {
            if ($this->isFilterable($key) && ! empty($value)) {
                $method = $this->getFilterMethod($key);
                if (method_exists($this, $method)) {
                    $this->$method($value);
                }
            }
        }

        return $builder;
    }

    private function isFilterable($key): bool
    {
        return in_array($key, $this->filterable) || array_key_exists($key, $this->filterable);
    }

    private function getFilterMethod($key): string
    {
        if (array_key_exists($key, $this->filterable) && is_string($this->filterable[$key])) {
            return $this->filterable[$key];
        }

        return $key;
    }
}
