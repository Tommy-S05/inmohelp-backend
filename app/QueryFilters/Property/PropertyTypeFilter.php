<?php

namespace App\QueryFilters\Property;

use Closure;

class PropertyTypeFilter
{
    public function handle($request, Closure $next)
    {
        if(!request()->has('property_type') || request()->input('property_type') == null) {
            return $next($request);
        }

        $builder = $next($request);

        return $builder->where('property_type_id', request()->input('property_type'));
    }
}
