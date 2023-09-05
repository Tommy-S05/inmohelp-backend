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
            'down_payment_available' => 2500000.00,
            'loan_term' => 20,
        ]);
    }
}
