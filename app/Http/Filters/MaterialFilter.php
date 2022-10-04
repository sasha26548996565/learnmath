<?php

declare(strict_types=1);

namespace App\Http\Filters;

use App\Http\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class MaterialFilter extends AbstractFilter
{
    public const CATEGORY_ID = 'category_id';

    public function getCallbacks(): array
    {
        return [
            self::CATEGORY_ID => [$this, 'categoryId'],
        ];
    }

    public function categoryId(Builder $builder, $value): void
    {
        $builder->where('category_id', $value);
    }
}
