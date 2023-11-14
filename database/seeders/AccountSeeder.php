<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $total_incomes = 225000;
        $total_expenses = 46370;
        $budget = ($total_incomes - $total_expenses) * 0.7;

        $newAccount = Account::create([
            'user_id' => 1,
            'total_incomes' => $total_incomes,
            'total_expenses' => $total_expenses,
            'budget' => $budget,
        ]);

        $subcategories = [
            [
                'subcategory_id' => 1,
                'amount' => 100000,
            ],
            [
                'subcategory_id' => 2,
                'amount' => 100000,
            ],
            [
                'subcategory_id' => 3,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 4,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 5,
                'amount' => 25000,
            ],
            [
                'subcategory_id' => 6,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 7,
                'amount' => 20000,
            ],
            [
                'subcategory_id' => 8,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 9,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 10,
                'amount' => 1500,
            ],
            [
                'subcategory_id' => 11,
                'amount' => 500,
            ],
            [
                'subcategory_id' => 12,
                'amount' => 1500,
            ],
            [
                'subcategory_id' => 13,
                'amount' => 1000,
            ],
            [
                'subcategory_id' => 14,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 15,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 16,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 17,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 18,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 19,
                'amount' => 1500,
            ],
            [
                'subcategory_id' => 20,
                'amount' => 250,
            ],
            [
                'subcategory_id' => 21,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 22,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 23,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 24,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 25,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 26,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 27,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 28,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 29,
                'amount' => 15000,
            ],
            [
                'subcategory_id' => 30,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 31,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 32,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 33,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 34,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 35,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 36,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 37,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 38,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 39,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 40,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 41,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 42,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 43,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 44,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 45,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 46,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 47,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 48,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 49,
                'amount' => 1000,
            ],
            [
                'subcategory_id' => 50,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 51,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 52,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 53,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 54,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 55,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 56,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 57,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 58,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 59,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 60,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 61,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 62,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 63,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 64,
                'amount' => 4000,
            ],
            [
                'subcategory_id' => 65,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 66,
                'amount' => 120,
            ],
            [
                'subcategory_id' => 67,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 68,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 69,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 70,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 71,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 72,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 73,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 74,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 75,
                'amount' => 0,
            ],
            [
                'subcategory_id' => 76,
                'amount' => 0,
            ],
        ];

        //        foreach($subCategories as $subCategory) {
        //            $results[] = array(
        //                "subcategory_id" => $subCategory['subcategory_id'],
        //                "amount" => $subCategory['amount'],
        //            );
        //        }

        $newAccount->accountTransactions()->createMany($subcategories);
    }
}
