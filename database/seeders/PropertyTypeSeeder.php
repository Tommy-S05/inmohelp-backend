<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PropertyType::create([
            'name' => 'Departamento',
            //            'slug' => Str::slug('Lenovo L340 Gaming', '-'),
            'slug' => 'departamento',
            'description' => 'Departamento de 1 piso',
            'thumbnail' => '/assets/categories/category-departamento.png',
            'is_active' => true
        ]);

        PropertyType::create([
            'name' => 'Casa',
            //            'slug' => Str::slug('Lenovo L340 Gaming', '-'),
            'slug' => 'casa',
            'description' => 'Casa de 1 piso',
            'thumbnail' => '/assets/categories/category-casa.png',
            'is_active' => true
        ]);

        PropertyType::create([
            'name' => 'Comercios',
            //            'slug' => Str::slug('Lenovo L340 Gaming', '-'),
            'slug' => 'comercios',
            'description' => 'Comercios',
            'thumbnail' => '/assets/categories/category-comercios.png',
            'is_active' => true
        ]);

        PropertyType::create([
            'name' => 'Countries',
            //            'slug' => Str::slug('Lenovo L340 Gaming', '-'),
            'slug' => 'countries',
            'description' => 'countries',
            'thumbnail' => '/assets/categories/category-countries.png',
            'is_active' => true
        ]);

        PropertyType::create([
            'name' => 'Hoteles',
            //            'slug' => Str::slug('Lenovo L340 Gaming', '-'),
            'slug' => 'hoteles',
            'description' => 'hoteles',
            'thumbnail' => '/assets/categories/category-hotel.png',
            'is_active' => true
        ]);

        PropertyType::create([
            'name' => 'Universidades',
            //            'slug' => Str::slug('Lenovo L340 Gaming', '-'),
            'slug' => 'universidades',
            'description' => 'universidades',
            'thumbnail' => '/assets/categories/category-universidad.png',
            'is_active' => true
        ]);

        PropertyType::create([
            'name' => 'Casa de Verano',
            'slug' => Str::slug('Casa de Verano', '-'),
            'description' => 'casa de verano',
            'thumbnail' => '/assets/categories/category-casadeverano.png',
            'is_active' => true
        ]);

        PropertyType::create([
            'name' => 'Almacenes',
            //            'slug' => Str::slug('Lenovo L340 Gaming', '-'),
            'slug' => 'almacenes',
            'description' => 'almacenes',
            'thumbnail' => '/assets/categories/category-almacenes2.png',
            'is_active' => true
        ]);

        //        PropertyType::create([
        //            'name' => 'Terreno',
        //            //            'slug' => Str::slug('Lenovo L340 Gaming', '-'),
        //            'slug' => 'terreno',
        //            'description' => 'Terreno de 1 piso',
        //            'thumbnail' => '/assets/categories/category-terreno.png',
        //            'status' => 'ACTIVE'
        //        ]);
        //
        //        PropertyType::create([
        //            'name' => 'Oficina',
        //            //            'slug' => Str::slug('Lenovo L340 Gaming', '-'),
        //            'slug' => 'oficina',
        //            'description' => 'Oficina de 1 piso',
        //            'thumbnail' => '/assets/categories/category-oficina.png',
        //            'status' => 'ACTIVE'
        //        ]);

    }
}
