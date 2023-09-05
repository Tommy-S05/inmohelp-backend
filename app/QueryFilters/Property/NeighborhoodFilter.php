<?php

namespace App\QueryFilters\Property;

use Closure;

class NeighborhoodFilter
{
    public function handle($request, Closure $next)
    {
        if(!request()->has('neighborhood') || request()->input('neighborhood') == null) {
            return $next($request);
        }

        return $next($request)->where('neighborhood_id', request()->input('neighborhood'));
    }
}
