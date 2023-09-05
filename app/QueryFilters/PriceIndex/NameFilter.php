<?php

namespace App\QueryFilters\PriceIndex;

use Closure;

class NameFilter
{
    public function handle($request, Closure $next)
    {
        //        $builder = $next($request);
        //
        //        if($names = $request->input('name')) {
        //            if(is_array($names)) {
        //                $builder->whereIn('name', $names);
        //            } else {
        //                $builder->where('name', 'like', '%' . $names . '%');
        //            }
        //        }
        //
        //        return $builder;
        if(!request()->has('name')) {
            return $next($request);
        }

        $names = request()->query('name');
        $builder = $next($request);

        foreach($names as $name) {
            //            $builder->orWhere('name', 'like', '%' . $name . '%');
            $builder->orWhere('id', '=', $name);
        }

        return $builder;
    }
}
