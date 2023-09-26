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
        Schema::create('amortization_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('amortization_id')->constrained()->cascadeOnDelete();
            $table->string('year');
            $table->string('period');
            $table->float('payment', 16, 2);
            $table->float('interest_paid', 16, 2)->default(0.00);
            $table->float('principal_paid', 16, 2)->default(0.00);
            $table->float('remaining_balance', 16, 2)->default(0.00);
            $table->date('payment_date');
            $table->boolean('is_paid')->default(false);
//            $table->date('paid_date')->nullable();
//            $table->float('paid_amount', 16, 2)->nullable();
//            $table->float('paid_interest', 16, 2)->nullable();
//            $table->float('paid_principal', 16, 2)->nullable();
//            $table->float('paid_balance', 16, 2)->nullable();
//            $table->float('paid_total_interest', 16, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amortization_details');
    }
};
