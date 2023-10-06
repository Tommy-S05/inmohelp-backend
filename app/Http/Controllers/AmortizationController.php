<?php

namespace App\Http\Controllers;

use App\Models\Amortization;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AmortizationController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $amortizations = $request->user()->amortizations()->get();

        return response()->json([
            'amortizations' => $amortizations,
        ]);
    }

    public function amortization(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'loan' => 'required|numeric',
            'periods' => 'required|numeric',
            'interest' => 'required|numeric',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Error al calcular la amortización',
                'errors' => $validator->errors()
            ], 422);
        }

        $loan = $request->loan;
        $periods = $request->periods * 12;
        $interest_rate = ($request->interest / 100) / 12;

        $monthly_payment = $loan * (($interest_rate * (1 + $interest_rate) ** $periods) / ((1 + $interest_rate) ** $periods - 1));

        $start_date = Carbon::now()->addMonth();
        $end_date = Carbon::now()->addMonth($periods);
        $current_date = $start_date;

        $amortization = [];
        $initial_balance = $loan;
        $remaining_balance = $loan;
        $total_cost_interest = 0;
        $total_cost_loan = 0;

        for($i = 1; $i <= $periods; $i++) {
            $payment_date = $current_date->format('F Y');

            $interest_paid = $remaining_balance * $interest_rate;
            $principal_paid = $monthly_payment - $interest_paid;
            $initial_balance = $remaining_balance;
            $remaining_balance = $remaining_balance - $principal_paid;

            $total_cost_interest += $interest_paid;
            $total_cost_loan += $monthly_payment;

            //            $amortization[$currentYear][$paymentDate] = [
            //            $amortization[$currentDate->year][] = [
            //                'period' => $paymentDate,
            //                'payment' => round($monthly_payment, 2),
            //                'interest_paid' => round($interest_paid, 2),
            //                'principal_paid' => round($principal_paid, 2),
            //                'balance' => round($balance, 2),
            //            ];

            $amortization[] = [
                'year' => $current_date->year,
                'period' => $payment_date,
                'payment' => round($monthly_payment, 2),
                'initial_balance' => round($initial_balance, 2),
                'interest_paid' => round($interest_paid, 2),
                'principal_paid' => round($principal_paid, 2),
                'remaining_balance' => round($remaining_balance, 2),
                'payment_date' => $current_date->format('Y-m-d'),
            ];

            $current_date->addMonth();
        }

        return response()->json([
            'summary' => [
                'loan' => floatval($loan),
                'periods' => $periods,
                'interest' => floatval($request->interest),
                'monthly_payment' => round($monthly_payment, 2),
                'total_cost_interest' => round($total_cost_interest, 2),
                'total_cost_loan' => round($total_cost_loan, 2),
                'remaining_balance' => round($loan, 2),
                'start_date' => $start_date->format('Y-m-d'),
                'end_date' => $end_date->format('Y-m-d'),
            ],
            'amortization_details' => $amortization,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'loan' => 'required|numeric',
            'periods' => 'required|numeric',
            'interest' => 'required|numeric',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Error al guardar la amortización',
                'errors' => $validator->errors()
            ], 422);
        }

        $loan = $request->loan;
        $initial_balance = $loan;
        $remaining_balance = $loan;
        $periods = $request->periods * 12;
        $interest_rate = ($request->interest / 100) / 12;
        $total_cost_interest = 0;
        $total_cost_loan = 0;

        $monthly_payment = $loan * (($interest_rate * (1 + $interest_rate) ** $periods) / ((1 + $interest_rate) ** $periods - 1));

        $start_date = Carbon::now()->addMonth();
        $end_date = Carbon::now()->addMonth($periods);
        $current_date = $start_date;

        $amortization = new Amortization();
        $amortization->user_id = $request->user()->id;
        $amortization->loan = $loan;
        $amortization->periods = $periods;
        $amortization->interest = $request->interest;
        $amortization->monthly_payment = round($monthly_payment, 2);
        $amortization->remaining_balance = round($remaining_balance, 2);
        $amortization->start_date = $start_date->format('Y-m-d');
        $amortization->end_date = $end_date->format('Y-m-d');
        $amortization->save();

        for($i = 1; $i <= $periods; $i++) {
            $payment_date = $current_date->format('F Y');

            $interest_paid = $remaining_balance * $interest_rate;
            $principal_paid = $monthly_payment - $interest_paid;
            $initial_balance = $remaining_balance;
            $remaining_balance = $remaining_balance - $principal_paid;

            $total_cost_interest += $interest_paid;
            $total_cost_loan += $monthly_payment;

            $amortization->amortizationDetails()->create([
                'year' => $current_date->year,
                'period' => $payment_date,
                'payment' => round($monthly_payment, 2),
                'initial_balance' => round($initial_balance, 2),
                'interest_paid' => round($interest_paid, 2),
                'principal_paid' => round($principal_paid, 2),
                'remaining_balance' => round($remaining_balance, 2),
                'payment_date' => $current_date,
            ]);

            $current_date->addMonth();
        }

        $amortization->total_cost_interest = round($total_cost_interest, 2);
        $amortization->total_cost_loan = round($total_cost_loan, 2);

        $amortization->save();

        return response()->json([
            'summary' => $amortization->only([
                'loan',
                'periods',
                'interest',
                'monthly_payment',
                'total_cost_interest',
                'total_cost_loan',
                'total_interest_paid',
                'total_principal_paid',
                'remaining_balance',
                'start_date',
                'end_date',
            ]),
            'amortization_details' => $amortization->amortizationDetails,
        ]);
    }

    public function show(Amortization $amortization): JsonResponse
    {
        return response()->json([
            'summary' => $amortization->only([
                'loan',
                'periods',
                'interest',
                'monthly_payment',
                'total_cost_interest',
                'total_cost_loan',
                'total_interest_paid',
                'total_principal_paid',
                'remaining_balance',
                'start_date',
                'end_date',
            ]),
            'amortization_details' => $amortization->amortizationDetails,
        ]);
    }

    public function destroy(Amortization $amortization): Response
    {
        $amortization->delete();
        return response()->noContent();
    }
}
