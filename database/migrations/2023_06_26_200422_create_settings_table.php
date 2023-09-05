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
        Schema::create('settings', function(Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->float('interest_rate', 8, 2)->default(0.00);
            $table->float('down_payment_available', 16, 4)->default(0.00);
            $table->integer('loan_term')->default(0);
            $table->boolean('is_active')->default(true);
            //            $table->decimal('down_payment_required', 2, 2)->default(0.00);
            //            $table->decimal('closing_cost', 2, 2)->default(0.00);
            //            $table->decimal('property_tax', 2, 2)->default(0.00);
            //            $table->decimal('home_insurance', 2, 2)->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
