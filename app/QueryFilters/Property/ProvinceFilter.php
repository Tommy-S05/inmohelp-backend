<?php

namespace App\QueryFilters\Property;

use Closure;

class ProvinceFilter
{
    public function handle($request, Closure $next)
    {
        if(!request()->has('province') || request()->input('province') == null) {
            return $next($request);
        }

        return $next($request)->where('province_id', request()->input('province'));
    }
}
