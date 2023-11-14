<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();


        $this->call([
            PermissionSeeder::class,
            UserSeeder::class,
            AmenitySeeder::class,
            PropertyStatusSeeder::class,
            PropertyTypeSeeder::class,
            CategorySeeder::class,
            SubcategorySeeder::class,
            SettingSeeder::class,
            RegionSeeder::class,
            ProvinceSeeder::class,
            MunicipalitySeeder::class,
            NeighborhoodSeeder::class,
            AccountSeeder::class,
        ]);


        //        Property::factory(20)->create();

        //        foreach (Property::all() as $property) {
        //            $amenities = \App\Models\Amenity::inRandomOrder()->take(rand(1, 5))->pluck('id');
        //            $property->amenities()->attach($amenities);
        //        }
    }
}
