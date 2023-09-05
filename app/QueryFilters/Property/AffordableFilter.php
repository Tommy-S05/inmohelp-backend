<?php

namespace App\QueryFilters\Property;

use App\Traits\FinancialsTrait;
use Closure;

class AffordableFilter
{
    use FinancialsTrait;

    public function handle($request, Closure $next)
    {

        if(request()->has('affordable') && request()->input('affordable') == 'true') {
            $available = $this->monthlyBudget()->getData();
            if(request()->has('purpose') && request()->input('purpose') == 'alquiler') {
                return $next($request)->where('price', '<=', $available);
            }

            return $next($request)->whereRaw('(' . $this->monthlyPaymentsSql() . ') <= ?', [$available]);
        }

        return $next($request);
    }
}
