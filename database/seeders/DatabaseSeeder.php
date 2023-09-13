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

        $user = User::factory()->create([
            'name' => 'Elber Galarga',
            'email' => 'elberg@hotmail.com',
            'username' => 'elberg',
            'phone_number' => '+1 (809) 852-2693'
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'username' => 'testuser',
        ]);

        $role = Role::create(['name' => 'Super Admin', 'guard_name' => 'web']);
        Role::create(['name' => 'User', 'guard_name' => 'web']);
        $user->assignRole($role);
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
