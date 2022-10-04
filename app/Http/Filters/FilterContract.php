<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

interface FilterContract
{
    public function apply(Builder $builder);
}
