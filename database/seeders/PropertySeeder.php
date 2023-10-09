<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\PropertyType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $name = 'Apartamento en Santo Domingo';
        Property::create([
            'code' => 0001,
            'name' => $name,
            'slug' => Str::slug($name),
            'user_id' => 1,
            'property_type_id' => 1,
            'thumbnail' => 'https://picsum.photos/640/480',
            'short_description' => 'Esta es la descripcion corta de la propiedad',
            'description' => 'Esta es la descripcion de la propiedad',
            'province' => 'Santo Domingo',
            'municipality' => 'Distrito Nacional',
            'neighborhood' => 'Piantini',
            'address' => 'direccion de la propiedad',
            'purpose' => 'Venta',
            'price' => 10000000,
            'area' => 200,
            'bedrooms' => 3,
            'bathrooms' => 4,
            'garages' => 2,
            'views' => 50,
            'featured' => true,
            'furnished' => true,
            'published_at' => now(),
        ]);
    }
}
