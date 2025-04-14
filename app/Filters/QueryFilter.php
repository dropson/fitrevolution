<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class QueryFilter
{
    protected $builder;

    protected $request;

    protected $filterable = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder)
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

    protected function isFilterable($key): bool
    {
        return in_array($key, $this->filterable) || array_key_exists($key, $this->filterable);
    }

    protected function getFilterMethod($key): string
    {
        if (array_key_exists($key, $this->filterable) && is_string($this->filterable[$key])) {
            return $this->filterable[$key];
        }

        return $key;
    }
}
