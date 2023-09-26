<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AmortizationController extends Controller
{
    //    public function amortization(): JsonResponse
    //    {
    //        $loan = 330000;
    //        $periods = 360;
    //        $interest = 0.0527 / 12;
    //
    //        $payment = $loan * (($interest * (1 + $interest) ** $periods) / ((1 + $interest) ** $periods - 1));
    //
    //        $amortization = [];
    //        $balance = $loan;
    //        for ($i = 1; $i <= $periods; $i++) {
    //            $interest_paid = $balance * $interest;
    //            $principal_paid = $payment - $interest_paid;
    //            $balance = $balance - $principal_paid;
    //            $amortization[] = [
    //                'period' => $i,
    //                'payment' => $payment,
    //                'interest_paid' => $interest_paid,
    //                'principal_paid' => $principal_paid,
    //                'balance' => $balance,
    //            ];
    //        }
    //
    //        return response()->json($amortization);
    //    }

    public function amortization(): JsonResponse
    {
        $loan = 330000;
        $periods = 360;
        $interestRate = 0.0527 / 12;

        $payment = $loan * (($interestRate * (1 + $interestRate) ** $periods) / ((1 + $interestRate) ** $periods - 1));

        $currentDate = Carbon::now()->addMonth();

        $amortization = [];
        $balance = $loan;
        $total_interest = 0;
        $total_cost = 0;

        for($i = 1; $i <= $periods; $i++) {
            $paymentDate = $currentDate->format('F');

            $interest_paid = $balance * $interestRate;
            $principal_paid = $payment - $interest_paid;
            $balance = $balance - $principal_paid;

            $total_interest += $interest_paid;
            $total_cost += $payment;

            //            $amortization[$currentYear][$paymentDate] = [
            $amortization[$currentDate->year][] = [
                'period' => $paymentDate,
                'payment' => round($payment, 2),
                'interest_paid' => round($interest_paid, 2),
                'principal_paid' => round($principal_paid, 2),
                'balance' => round($balance, 2),
            ];

            $currentDate->addMonth();
        }

        return response()->json([
            'monthly_payment' => round($payment, 2),
            'total_interest' => round($total_interest, 2),
            'total_cost' => round($total_cost, 2),
            'amortization' => $amortization,
        ]);
    }
}
