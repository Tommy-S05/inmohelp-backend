<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create([
            'name' => 'ver_todos:Usuarios',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'mostrar:Usuarios',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'crear:Usuarios',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'actualizar:Usuarios',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'eliminar:Usuarios',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'ver_todos:Roles',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'mostrar:Roles',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'crear:Roles',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'actualizar:Roles',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'eliminar:Roles',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'ver_todos:Permisos',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'mostrar:Permisos',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'crear:Permisos',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'actualizar:Permisos',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'eliminar:Permisos',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'ver_todos:Propiedades',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'mostrar:Propiedades',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'crear:Propiedades',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'actualizar:Propiedades',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'eliminar:Propiedades',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'ver_todos:Estados de propiedad',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'mostrar:Estados de propiedad',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'crear:Estados de propiedad',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'actualizar:Estados de propiedad',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'eliminar:Estados de propiedad',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'ver_todos:Tipos de propiedad',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'mostrar:Tipos de propiedad',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'crear:Tipos de propiedad',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'actualizar:Tipos de propiedad',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'eliminar:Tipos de propiedad',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'ver_todos:Amenidades',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'mostrar:Amenidades',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'crear:Amenidades',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'actualizar:Amenidades',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'eliminar:Amenidades',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'ver_todos:Categorias',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'mostrar:Categorias',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'crear:Categorias',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'actualizar:Categorias',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'eliminar:Categorias',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'ver_todos:Subcategorias',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'mostrar:Subcategorias',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'crear:Subcategorias',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'actualizar:Subcategorias',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'eliminar:Subcategorias',
            'guard_name' => 'web'
        ]);
    }
}
