<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::factory()->create([
            'name' => 'Tommy Sanchez',
            'email' => 'tommy-s05@hotmail.com',
            'username' => 'tommy',
            'phone_number' => '+1 (809) 852-2693'
        ]);

        $user2 = User::factory()->create([
            'name' => 'Francisco Pimentel',
            'email' => 'franp@hotmail.com',
            'username' => 'francisco',
            'phone_number' => '+1 (809) 478-6098'
        ]);

        $user3 = User::factory()->create([
            'name' => 'Elian Maria',
            'email' => 'elianm@hotmail.com',
            'username' => 'elian',
            'phone_number' => '+1 (829) 828-1215'
        ]);

        $user4 = User::factory()->create([
            'name' => 'Bran Estrella',
            'email' => 'brane@hotmail.com',
            'username' => 'bran',
            'phone_number' => '+1 (809) 586-9422'
        ]);

        $user5 = User::factory()->create([
            'name' => 'Elber Galarga',
            'email' => 'elberg@hotmail.com',
            'username' => 'elberg',
            'phone_number' => '+1 (809) 853-2904'
        ]);

        //        User::factory()->create([
        //            'name' => 'Test User',
        //            'email' => 'test@example.com',
        //            'username' => 'testuser',
        //        ]);

        $role1 = Role::create(['name' => 'Super Admin', 'guard_name' => 'web']);
        $role2 = Role::create(['name' => 'Admin', 'guard_name' => 'web']);
        $role3 = Role::create(['name' => 'Agente', 'guard_name' => 'web']);
        $role4 = Role::create(['name' => 'Cliente', 'guard_name' => 'web']);

        $user1->assignRole($role1);
        $user2->assignRole($role2);
        $user3->assignRole($role3);
        $user4->assignRole($role3);
        $user5->assignRole($role4);
    }
}
