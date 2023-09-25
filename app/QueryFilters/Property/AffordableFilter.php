<?php

namespace App\QueryFilters\Property;

use App\Traits\FinancialsTrait;
use Closure;

class AffordableFilter
{
    use FinancialsTrait;

    public function handle($request, Closure $next)
    {
        if (request()->has('affordable') && request()->input('affordable') == 'true') {
            $available = $this->monthlyBudget()->getData();
            if (request()->has('purpose') && request()->input('purpose') == 'alquiler') {
                return $next($request)
                    ->where('purpose', request()->input('purpose'))
                    ->where('price', '<=', $available);
            } elseif (request()->has('purpose') && request()->input('purpose') == 'venta') {
                return $next($request)
                    ->where('purpose', request()->input('purpose'))
                    ->whereRaw('(' . $this->monthlyPaymentsSql() . ') <= ?', [$available]);
            } else {
                return $next($request)
                    ->where(function ($query) use ($available) {
                        $query->where('purpose', 'alquiler')
                            ->where('price', '<=', $available);
                    })
                    ->orWhere(function ($query) use ($available) {
                        $query->where('purpose', 'venta')
                            ->whereRaw('(' . $this->monthlyPaymentsSql() . ') <= ?', [$available]);
                    });
            }
        }

        return $next($request);
    }
}
