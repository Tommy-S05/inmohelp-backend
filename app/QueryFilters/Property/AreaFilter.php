<?php

namespace App\QueryFilters\Property;

use Closure;

class AreaFilter
{
    public function handle($request, Closure $next)
    {
        if(!request()->has('area') || request()->input('area') == null) {
            return $next($request);
        }

        $builder = $next($request);

        return $builder->where('area', '<=', request()->input('area'));
    }
}
