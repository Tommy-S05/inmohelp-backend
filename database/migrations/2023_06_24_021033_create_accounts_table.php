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
        Schema::create('accounts', function(Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            //            $table->enum('type', ['income', 'expense']);
            //            $table->decimal('total', 16, 6)->nullable();
            $table->float('total_incomes', 16, 6);
            $table->float('total_expenses', 16, 6);
            $table->float('budget', 16, 6);
            //            $table->string('description')->nullable();
            $table->boolean('is_active')->default(true);
            //            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
