<?php

namespace App\Models\Traits;

use App\Http\Filters\FilterContract;
use App\Http\Filters\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * @param Builder $builder
     * @param FilterInterface $filter
     *
     * @return Builder
     */
    public function scopeFilter(Builder $builder, FilterContract $filter)
    {
        $filter->apply($builder);

        return $builder;
    }
}
