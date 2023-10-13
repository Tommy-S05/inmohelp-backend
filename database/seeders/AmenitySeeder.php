<?php

namespace Database\Seeders;

use App\Models\Amenity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Amenity::create([
            'name' => 'pisina'
        ]);

        Amenity::create([
            'name' => 'gimnasio'
        ]);

        Amenity::create([
            'name' => 'sauna'
        ]);

        Amenity::create([
            'name' => 'jacuzzi'
        ]);

        Amenity::create([
            'name' => 'cancha de tenis'
        ]);

        Amenity::create([
            'name' => 'cancha de futbol'
        ]);

        Amenity::create([
            'name' => 'Ascensor'
        ]);

        Amenity::create([
            'name' => 'parqueadero'
        ]);

        Amenity::create([
            'name' => 'parque infantil'
        ]);

        Amenity::create([
            'name' => 'salon comunal'
        ]);

        Amenity::create([
            'name' => 'vigilancia'
        ]);

        Amenity::create([
            'name' => 'zona BBQ'
        ]);

        Amenity::create([
            'name' => 'zona de juegos'
        ]);

        Amenity::create([
            'name' => 'zona verde'
        ]);

        Amenity::create([
            'name' => 'Salón de eventos'
        ]);

        Amenity::create([
            'name' => 'Area común'
        ]);
    }
}
