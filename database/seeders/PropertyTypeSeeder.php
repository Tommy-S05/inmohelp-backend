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
            'name' => 'Apartamento',
            'slug' => 'apartamento',
            'description' => 'Apartamento',
            'code' => 'APT',
            //            'thumbnail' => '/assets/categories/category-departamento.png',
            'is_active' => true
        ]);

        PropertyType::create([
            'name' => 'Casa',
            'slug' => 'casa',
            'description' => 'Casa',
            'code' => 'CAS',
            //            'thumbnail' => '/assets/categories/category-casa.png',
            'is_active' => true
        ]);

        //        PropertyType::create([
        //            'name' => 'Comercios',
        //            'slug' => 'comercios',
        //            'description' => 'Comercios',
        //            'code' => 'COM',
        //            //            'thumbnail' => '/assets/categories/category-comercios.png',
        //            'is_active' => true
        //        ]);
        //
        //        PropertyType::create([
        //            'name' => 'Countries',
        //            'slug' => 'countries',
        //            'description' => 'countries',
        //            'code' => 'COU',
        //            //            'thumbnail' => '/assets/categories/category-countries.png',
        //            'is_active' => true
        //        ]);
        //
        //        PropertyType::create([
        //            'name' => 'Hoteles',
        //            'slug' => 'hoteles',
        //            'description' => 'hoteles',
        //            'code' => 'HOT',
        //            //            'thumbnail' => '/assets/categories/category-hotel.png',
        //            'is_active' => true
        //        ]);
        //
        //        PropertyType::create([
        //            'name' => 'Universidades',
        //            'slug' => 'universidades',
        //            'description' => 'universidades',
        //            'code' => 'UNI',
        //            //            'thumbnail' => '/assets/categories/category-universidad.png',
        //            'is_active' => true
        //        ]);

        PropertyType::create([
            'name' => 'Casa de Verano',
            'slug' => Str::slug('Casa de Verano', '-'),
            'description' => 'casa de verano',
            'code' => 'CAV',
            //            'thumbnail' => '/assets/categories/category-casadeverano.png',
            'is_active' => true
        ]);

        PropertyType::create([
            'name' => 'Villa',
            'slug' => Str::slug('villa', '-'),
            'description' => 'Villa',
            'code' => 'VIL',
            //            'thumbnail' => '/assets/categories/category-casadeverano.png',
            'is_active' => true
        ]);

        //        PropertyType::create([
        //            'name' => 'Almacenes',
        //            'slug' => 'almacenes',
        //            'description' => 'almacenes',
        //            'code' => 'ALM',
        //            //            'thumbnail' => '/assets/categories/category-almacenes2.png',
        //            'is_active' => true
        //        ]);

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
