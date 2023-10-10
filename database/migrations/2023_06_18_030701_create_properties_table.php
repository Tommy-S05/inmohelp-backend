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
            $table->foreignId('property_type_id')->constrained('property_types');
            $table->string('thumbnail')->nullable();
            //            $table->foreignId('property_condition_id')->constrained('property_conditions')->cascadeOnDelete();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->foreignId('province_id')->constrained('provinces');
            $table->foreignId('municipality_id')->constrained('municipalities');
            $table->foreignId('neighborhood_id')->constrained('neighborhoods');
            $table->string('address');
            $table->text('map')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->enum('purpose', ['Venta', 'Alquiler']);
            //            $table->string('property_type'); //Casa, Apartamento, Local, Terreno, Oficina, Edificio, Finca, Bodega, Lote, Consultorio, Casa Campestre, Casa Lote, Casa en Condominio, Casa en Conjunto Cerrado, Casa en Unidad Cerrada, Casa en Unidad Residencial
            $table->float('price', 12, 2);
            $table->float('area');
            $table->float('bedrooms')->nullable();
            $table->float('bathrooms', 4, 1)->nullable();
            $table->float('garages')->nullable();
            $table->string('status')->nullable();//Nuevo, Usado, En Construcción, Sobre Planos, Remodelado
            $table->integer('floors')->nullable();
            $table->integer('views')->default(0);
            $table->boolean('featured')->default(false);//Destacado
            //            $table->boolean('outstanding')->default(false);//Destacado
            $table->boolean('available')->default(true);
            $table->boolean('negotiable')->default(false);
            $table->boolean('furnished')->default(false)->nullable();//Amueblado
            //            $table->integer('likes')->default(0)->nullable();
            //            $table->integer('dislikes')->default(0)->nullable();
            //            $table->integer('comments')->default(0)->nullable();
            //            $table->integer('favorites')->default(0)->nullable();
            //            $table->integer('visits')->default(0)->nullable();
            $table->boolean('published')->default(true);
            $table->datetime('published_at')->nullable();
            $table->date('year_built')->nullable();
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
