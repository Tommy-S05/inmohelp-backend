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
//            $interestPaid = $balance * $interest;
//            $principalPaid = $payment - $interestPaid;
//            $balance = $balance - $principalPaid;
//            $amortization[] = [
//                'period' => $i,
//                'payment' => $payment,
//                'interest_paid' => $interestPaid,
//                'principal_paid' => $principalPaid,
//                'balance' => $balance,
//            ];
//        }
//
//        return response()->json($amortization);
//    }

    public function amortization()/*: JsonResponse*/
    {
        $loan = 330000;
        $periods = 360;
        $interestRate = 0.0527 / 12;

        $payment = $loan * (($interestRate * (1 + $interestRate) ** $periods) / ((1 + $interestRate) ** $periods - 1));

        $currentDate = Carbon::now()->addMonth();
        $currentYear = $currentDate->year;
        $currentMonth = $currentDate->month;

        $amortization = [];
        $balance = $loan;

        for ($i = 1; $i <= $periods; $i++) {
            // Calcula la fecha del pago
            $paymentDate = $currentDate->format('F Y');

            $interestPaid = $balance * $interestRate;
            $principalPaid = $payment - $interestPaid;
            $balance = $balance - $principalPaid;

            $amortization[$currentYear][$paymentDate] = [
                'period' => $paymentDate,
                'payment' => $payment,
                'interest_paid' => $interestPaid,
                'principal_paid' => $principalPaid,
                'balance' => $balance,
            ];

            // Avanza al siguiente mes
            $currentDate->addMonth();

            // Avanza al siguiente año si es diciembre
            if ($currentMonth == 12) {
                $currentYear++;
                $currentMonth = 1;
            } else {
                $currentMonth++;
            }
        }

        return response()->json($amortization);
    }
}
