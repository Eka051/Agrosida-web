<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'user_id' => Str::uuid(),
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'agrosida@gmail.com',
            'password' => bcrypt('agrosida'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $user->assignRole('Admin');
    }
}
