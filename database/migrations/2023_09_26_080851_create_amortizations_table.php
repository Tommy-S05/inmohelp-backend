<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('amortizations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->float('loan', 16, 2);
            $table->integer('periods');
            $table->float('interest', 8, 2);
            $table->float('monthly_payment', 16, 2)->default(0.00);
            $table->float('total_cost_interest', 16, 2)->default(0.00);
            $table->float('total_cost_loan', 16, 2)->default(0.00);
            $table->float('total_interest_paid', 16, 2)->default(0.00);
            $table->float('total_principal_paid', 16, 2)->default(0.00);
            $table->float('remaining_balance', 16, 2)->default(0.00);
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amortizations');
    }
};
