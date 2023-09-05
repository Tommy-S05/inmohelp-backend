<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use App\Models\Neighborhood;
use App\Models\Setting;
use App\QueryFilters\PriceIndex\NameFilter;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class PriceIndexController extends Controller
{
    //    public function index(Request $request)
    //    {
    //        $settings = Setting::where('user_id', 1)->first();
    //        $downPayment = $settings->down_payment_available;
    //        $account = Account::where('user_id', 1)->first();
    //        $grossIncomesAnnual = $account->total_incomes * 12;
    //
    //        $minLoan = $grossIncomesAnnual * 2;
    //        $maxLoan = $grossIncomesAnnual * 2.5;
    //        $priceIndex = app(Pipeline::class)
    //            ->send(Neighborhood::query())
    //            ->through([
    //                NameFilter::class,
    //            ])
    //            ->thenReturn()
    //            ->get(['name', 'code', 'identifier', 'averagePrice']);
    //
    //        foreach($priceIndex as $neighborhood) {
    //            $neighborhood->maxArea = ($downPayment / $neighborhood->averagePrice) + ($minLoan / $neighborhood->averagePrice);
    //            //            $neighborhood->maxArea = $downPayment / $neighborhood->averagePrice;
    //        }
    //        return response()->json($priceIndex);
    //    }

    public function index(Request $request)
    {
        $settings = Setting::where('user_id', Auth::user()->id)->first();
        $downPayment = $settings->down_payment_available;

        $account = Account::where('user_id', Auth::user()->id)->first();
        $available = $account->budget * 0.7;

        // Calcular el monto del préstamo
        $loanAmount = $this->calculateLoanAmount($available, $settings->interest_rate, $settings->loan_term);

        $priceIndex = app(Pipeline::class)
            ->send(Neighborhood::query())
            ->through([
                NameFilter::class,
            ])
            ->thenReturn()
            ->get(['name', 'code', 'identifier', 'averagePrice']);

        // Calcular el tamaño máximo de área que el usuario puede comprar en cada vecindario
        foreach($priceIndex as $neighborhood) {
            $neighborhood->maxArea = ($downPayment / $neighborhood->averagePrice) + $loanAmount / $neighborhood->averagePrice;
        }

        return response()->json($priceIndex);
    }

    private function calculateLoanAmount($available, $interestRate, $loanTerm)
    {
        $monthlyInterestRate = (((1 + ($interestRate / 100)) ** (1 / 12)) - 1);
        $numberOfPayments = $loanTerm * 12;

        $loanAmount = $available * (pow(1 + $monthlyInterestRate, $numberOfPayments) - 1) / ($monthlyInterestRate * pow(1 + $monthlyInterestRate, $numberOfPayments));

        return $loanAmount;
    }
}
