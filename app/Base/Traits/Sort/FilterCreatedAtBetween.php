<?php

namespace App\Base\Traits\Sort;

use Carbon\Carbon;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FilterCreatedAtBetween implements Filter
{
    public function __invoke(Builder $query, $value,  string $property)
    {
        $relationships = explode('.', $property);
        $table = $relationships[0];
        $operator = '>=';
        $value_in = Carbon::parse($value);
        if ($property == $table . '.created_to') {
            $operator = '<=';
            $value_in = Carbon::parse($value)->endOfDay();
        }
        $property = $table . '.created_at';
        $query->where($property, $operator, $value_in);
    }
}
