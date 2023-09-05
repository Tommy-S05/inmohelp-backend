<?php

namespace App\Traits;

use App\Models\Account;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait FinancialsTrait
{
    public function monthlyPayments(Request $request)
    {
        $settings = Setting::where('user_id', 1)->first();
        //        $property = Property::find($property_id);
        if($request->price < $settings->down_payment_available) {
            $payment = 0;
            return response()->json($payment);
        }
        $loan = $request->price - $settings->down_payment_available;
        $periods = $settings->loan_term * 12;
        $interest = (((1 + ($settings->interest_rate / 100)) ** (1 / 12)) - 1);

        $payment = $loan * (($interest * (1 + $interest) ** $periods) / ((1 + $interest) ** $periods - 1));
        //        $payment = ($interest * $loan) / (1 - (1 + $interest) ** (-$periods));
        return response()->json($payment);
    }

    public function monthlyPaymentsSql()
    {
        $settings = Setting::where('user_id', 1)->first();
        $periods = $settings->loan_term * 12;
        $interest = (((1 + ($settings->interest_rate / 100)) ** (1 / 12)) - 1);
        $downPayment = $settings->down_payment_available;

        $sql = "CASE
                WHEN price < $downPayment THEN 0
                ELSE (price - $downPayment) * (($interest * POW((1 + $interest), $periods)) / (POW((1 + $interest), $periods) - 1))
            END";

        return $sql;
    }

    public function monthlyBudget()
    {
        $account = Account::where('user_id', Auth::user()->id)->first();
        //        $account = Account::where('user_id', 1)->first();
        $available = $account->budget * 0.7;
        return response()->json($available);
    }

    public function monthlyBudget2()
    {
        $account = Account::where('user_id', Auth::user()->id)->first();
        //        $account = Account::where('user_id', 1)->first();
        $available = $account->total_incomes * 0.28;
        $houseSpend = $account->accountTransactions()
            ->join('sub_categories', 'account_transactions.sub_category_id', '=', 'sub_categories.id')
            ->join('categories', 'sub_categories.category_id', '=', 'categories.id')
            ->where('categories.id', 2)
            ->sum('account_transactions.amount');
        $available = $available - $houseSpend;
        return response()->json($available);
    }
}
