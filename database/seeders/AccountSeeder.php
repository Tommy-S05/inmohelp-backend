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
        $budget = $total_incomes - $total_expenses;

        $newAccount = Account::create([
            'user_id' => 1,
            'total_incomes' => $total_incomes,
            'total_expenses' => $total_expenses,
            'budget' => $budget,
        ]);

        $subCategories = [
            [
                'sub_category_id' => 1,
                'amount' => 100000,
            ],
            [
                'sub_category_id' => 2,
                'amount' => 100000,
            ],
            [
                'sub_category_id' => 3,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 4,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 5,
                'amount' => 25000,
            ],
            [
                'sub_category_id' => 6,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 7,
                'amount' => 20000,
            ],
            [
                'sub_category_id' => 8,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 9,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 10,
                'amount' => 1500,
            ],
            [
                'sub_category_id' => 11,
                'amount' => 500,
            ],
            [
                'sub_category_id' => 12,
                'amount' => 1500,
            ],
            [
                'sub_category_id' => 13,
                'amount' => 1000,
            ],
            [
                'sub_category_id' => 14,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 15,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 16,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 17,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 18,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 19,
                'amount' => 1500,
            ],
            [
                'sub_category_id' => 20,
                'amount' => 250,
            ],
            [
                'sub_category_id' => 21,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 22,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 23,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 24,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 25,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 26,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 27,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 28,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 29,
                'amount' => 15000,
            ],
            [
                'sub_category_id' => 30,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 31,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 32,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 33,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 34,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 35,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 36,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 37,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 38,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 39,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 40,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 41,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 42,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 43,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 44,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 45,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 46,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 47,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 48,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 49,
                'amount' => 1000,
            ],
            [
                'sub_category_id' => 50,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 51,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 52,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 53,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 54,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 55,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 56,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 57,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 58,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 59,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 60,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 61,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 62,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 63,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 64,
                'amount' => 4000,
            ],
            [
                'sub_category_id' => 65,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 66,
                'amount' => 120,
            ],
            [
                'sub_category_id' => 67,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 68,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 69,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 70,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 71,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 72,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 73,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 74,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 75,
                'amount' => 0,
            ],
            [
                'sub_category_id' => 76,
                'amount' => 0,
            ],
        ];

        //        foreach($subCategories as $subCategory) {
        //            $results[] = array(
        //                "sub_category_id" => $subCategory['sub_category_id'],
        //                "amount" => $subCategory['amount'],
        //            );
        //        }

        $newAccount->accountTransactions()->createMany($subCategories);
    }
}
