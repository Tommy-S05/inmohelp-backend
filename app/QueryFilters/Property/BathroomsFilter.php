<?php

namespace App\QueryFilters\Property;

use Closure;

class BathroomsFilter
{
    public function handle($request, Closure $next)
    {
        if(!request()->has('bathrooms') || request()->input('bathrooms') == null) {
            return $next($request);
        }

        return $next($request)->where('bathrooms', request()->input('bathrooms'));
    }
}
