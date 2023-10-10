<?php

namespace Database\Seeders;

use App\Models\PropertyStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertyStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PropertyStatus::create([
            'name' => 'Nuevo',
            'description' => 'Nuevo',
        ]);

        PropertyStatus::create([
            'name' => 'Usado',
            'description' => 'Usado',
        ]);

        PropertyStatus::create([
            'name' => 'En Construcción',
            'description' => 'En Construcción',
        ]);

        PropertyStatus::create([
            'name' => 'Sobre Planos',
            'description' => 'Sobre Planos',
        ]);

        PropertyStatus::create([
            'name' => 'Remodelado',
            'description' => 'Remodelado',
        ]);

        PropertyStatus::create([
            'name' => 'En Proceso de Construcción',
            'description' => 'En Proceso de Construcción',
        ]);

        PropertyStatus::create([
            'name' => 'En Proceso de Remodelación',
            'description' => 'En Proceso de Remodelación',
        ]);

        PropertyStatus::create([
            'name' => 'En Proceso de Ampliación',
            'description' => 'En Proceso de Ampliación',
        ]);

        PropertyStatus::create([
            'name' => 'En Proceso de Mantenimiento',
            'description' => 'En Proceso de Mantenimiento',
        ]);

        PropertyStatus::create([
            'name' => 'En Proceso de Reparación',
            'description' => 'En Proceso de Reparación',
        ]);

        PropertyStatus::create([
            'name' => 'En Proceso de Pintura',
            'description' => 'En Proceso de Pintura',
        ]);
    }
}
