<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'user_id' => 1,
            'interest_rate' => 12.0,
            'down_payment_available' => 3500000.00,
            'loan_term' => 20,
        ]);

        Setting::create([
            'user_id' => 2,
            'interest_rate' => 12.0,
            'down_payment_available' => 1000000.00,
            'loan_term' => 20,
        ]);

        Setting::create([
            'user_id' => 3,
            'interest_rate' => 12.0,
            'down_payment_available' => 1500000.00,
            'loan_term' => 20,
        ]);

        Setting::create([
            'user_id' => 4,
            'interest_rate' => 12.0,
            'down_payment_available' => 2500000.00,
            'loan_term' => 20,
        ]);

        Setting::create([
            'user_id' => 5,
            'interest_rate' => 12.0,
            'down_payment_available' => 500000.00,
            'loan_term' => 20,
        ]);
    }
}
