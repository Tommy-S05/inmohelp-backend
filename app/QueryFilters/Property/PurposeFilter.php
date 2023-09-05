<?php

namespace App\QueryFilters\Property;

use Closure;

class PurposeFilter
{
    public function handle($request, Closure $next)
    {
        if(!request()->has('purpose') || request()->input('purpose') == null) {
            return $next($request);
        }

        return $next($request)->where('purpose', request()->input('purpose'));
    }
}
