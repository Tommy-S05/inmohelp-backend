<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $accounts = Account::where('user_id', Auth::user()->id)->get();
        return response()->json($accounts->load('accountTransactions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $budget = $request->total_incomes - $request->total_expenses;

        $newAccount = Account::create([
            'user_id' => Auth::user()->id,
            //            'user_id' => 1,
            'total_incomes' => $request->total_incomes,
            'total_expenses' => $request->total_expenses,
            'budget' => $budget,
        ]);
        foreach($request->subCategories as $subCategory) {
            $results[] = array(
                "sub_category_id" => $subCategory['subCategory_id'],
                "amount" => $subCategory['amount'],
            );
        }

        $newAccount->accountTransactions()->createMany($results);
        return response()->json([
            'success' => true,
            'message' => 'Account created successfully',
            'data' => $newAccount->load('accountTransactions')
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request/*, string $id*/)
    {
        $account = Account::where('user_id', Auth::user()->id)->firstOrFail();
        //            ->findOrFail($id);
        //        $account = Account::where('id', $id)->firstOrFail();
        $budget = $request->total_incomes - $request->total_expenses;

        $account->update([
            'total_incomes' => $request->total_incomes,
            'total_expenses' => $request->total_expenses,
            'budget' => $budget,
        ]);

        foreach($request->subCategories as $subCategory) {
            $results[] = array(
                "sub_category_id" => $subCategory['subCategory_id'],
                "amount" => $subCategory['amount'],
            );
        }

        $account->accountTransactions()->delete();
        $account->accountTransactions()->createMany($results);

        return response()->json([
            'success' => true,
            'message' => 'Account updated successfully',
            'data' => $account->load('accountTransactions')
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //        $account = Account::where('user_id', Auth::user()->id)
        //            ->findOrFail($id);
        $account = Account::where('user_id', Auth::user()->id)->firstOrFail();
        $account->accountTransactions()->delete();
        $account->delete();
        return response()->json([
            'success' => true,
            'message' => 'Account deleted successfully',
            'data' => ''
        ], 200);
    }
}
