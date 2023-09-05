<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Property;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Elber Galarga',
            'email' => 'elberg@hotmail.com',
            'username' => 'elberg',
        ]);
        $this->call([
            PropertyTypeSeeder::class,
            CategorySeeder::class,
            SubCategorySeeder::class,
            SettingSeeder::class,
            RegionSeeder::class,
            ProvinceSeeder::class,
            MunicipalitySeeder::class,
            NeighborhoodSeeder::class,
            AccountSeeder::class,
        ]);
        Property::factory(20)->create();
    }
}
