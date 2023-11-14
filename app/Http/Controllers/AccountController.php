<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountTransaction;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $account = Account::where('user_id', Auth::user()->id)->firstOrFail(['id', 'total_expenses', 'total_incomes', 'budget']);

        $categories = Category::with(['subcategories.accountTransactions' => function($query) use ($account) {
            $query->where('account_id', $account->id)->select('subcategory_id', 'amount');
        }, 'subcategories:id,name,category_id'])->get(['id', 'name', 'type']);

        return response()->json([
            'account' => $account,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $budget = ($request->total_incomes - $request->total_expenses) * 0.7;

        $newAccount = Account::create([
            'user_id' => Auth::user()->id,
            //            'user_id' => 1,
            'total_incomes' => $request->total_incomes,
            'total_expenses' => $request->total_expenses,
            'budget' => $budget,
        ]);
        foreach($request->subCategories as $subCategory) {
            $results[] = array(
                "subcategory_id" => $subCategory['subCategory_id'],
                "amount" => $subCategory['amount'],
            );
        }

        $newAccount->accountTransactions()->createMany($results);
        return response()->json($newAccount->load('accountTransactions'), 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $total_incomes = 0;
        $total_expenses = 0;

        $account = Account::where('user_id', Auth::user()->id)->firstOrFail();

        foreach($request->data['categories'] as $category) {
            $type = $category['type'];

            foreach($category['subcategories'] as $subcategory) {
                $amount = $subcategory['account_transactions'][0]['amount'];

                if(!$amount || $amount < 0) {
                    $amount = 0;
                }

                if($type === 'income') {
                    $total_incomes += $amount;
                } elseif($type === 'expense') {
                    $total_expenses += $amount;
                }

                $subcategoryId = $subcategory['id'];
                $accountTransaction = $account->accountTransactions()->where('subcategory_id', $subcategoryId)->first();

                if($accountTransaction) {
                    $accountTransaction->update([
                        'amount' => $amount
                    ]);
                } else {
                    $account->accountTransactions()->create([
                        "subcategory_id" => $subcategory['id'],
                        "amount" => $subcategory['amount']
                    ]);
                }
            }
        }
        $budget = ($total_incomes - $total_expenses) * 0.7;

        $account->update([
            'total_incomes' => $total_incomes,
            'total_expenses' => $total_expenses,
            'budget' => $budget,
        ]);

        return response()->json($account->load('accountTransactions'));
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
        return response()->noContent();
    }
}
