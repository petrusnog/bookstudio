<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class
        ]);

        User::factory()->create([
            'name' => 'Junior Bala',
            'email' => 'juniorbala@abrigonuclear.com',
            'phone' => '85999999999',
            'password' => Hash::make('abrigonuclear'),
            'role_id' => 1,
        ]);

        User::factory()->create([
            'name' => 'Banda Sommelier',
            'email' => 'rennan@bandasommelier.com',
            'password' => Hash::make('bandasommelier'),
            'phone' => '85999999999',
            'role_id' => 2,
        ]);
    }
}
