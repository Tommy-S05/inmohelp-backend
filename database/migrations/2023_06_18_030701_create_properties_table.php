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
        Schema::create('properties', function(Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('property_type_id')->constrained('property_types')->cascadeOnDelete();
            $table->longText('description')->nullable();
            $table->foreignId('province_id')->constrained('provinces');
            $table->foreignId('neighborhood_id')->constrained('neighborhoods');
            $table->string('address')->nullable();
            $table->text('map')->nullable();
            $table->enum('purpose', ['Venta', 'Alquiler']);
            //            $table->string('property_type'); //Casa, Apartamento, Local, Terreno, Oficina, Edificio, Finca, Bodega, Lote, Consultorio, Casa Campestre, Casa Lote, Casa en Condominio, Casa en Conjunto Cerrado, Casa en Unidad Cerrada, Casa en Unidad Residencial
            $table->float('price', 12, 2);
            $table->double('area');
            $table->float('bedrooms');
            $table->float('bathrooms');
            $table->float('garages');
            $table->integer('floors')->nullable();
            $table->integer('views')->default(0);
            $table->boolean('outstanding')->default(false);//Destacado
            $table->boolean('sold')->default(false)->nullable();
            $table->boolean('rented')->default(false)->nullable();
            $table->boolean('available')->default(true);
            $table->boolean('negotiable')->default(false)->nullable();
            $table->boolean('furnished')->default(false)->nullable();//Amueblado
            //            $table->integer('likes')->default(0)->nullable();
            //            $table->integer('dislikes')->default(0)->nullable();
            //            $table->integer('comments')->default(0)->nullable();
            //            $table->integer('favorites')->default(0)->nullable();
            //            $table->integer('visits')->default(0)->nullable();
            $table->datetime('published_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
