<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::insert([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'dianekaraharjo@gmail.com',
            'password' => bcrypt('agrosida2024'),
        ]);

        Role::insert([
            ['name' => 'admin'],
            ['name' => 'user'],
            ['name' => 'seller'],
        ]);
    }
}
