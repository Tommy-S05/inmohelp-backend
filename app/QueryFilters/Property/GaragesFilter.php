<?php

namespace App\QueryFilters\Property;

use Closure;

class GaragesFilter
{
    public function handle($request, Closure $next)
    {
        if(!request()->has('garages') || request()->input('garages') == null) {
            return $next($request);
        }

        return $next($request)->where('garages', request()->input('garages'));
    }
}
