<?php

namespace App\QueryFilters\Property;

use Closure;

class BedroomsFilter
{
    public function handle($request, Closure $next)
    {
        if(!request()->has('bedrooms') || request()->input('bedrooms') == null) {
            return $next($request);
        }

        return $next($request)->where('bedrooms', request()->input('bedrooms'));
    }
}
