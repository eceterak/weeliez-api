<?php

namespace App\Filters;

class BrandFilters extends QueryFilter
{
    protected $filters = [
        'name'
    ];

    /**
     * Filter by name
     * 
     * @param int $value
     * @return QueryBuilder
     */
    public function name($value = null)
    {
        return $this->builder->whereRaw('name LIKE ?', $value.'%');
    }
}