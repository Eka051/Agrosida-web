<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            'user_id' => Str::uuid(),
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'dianekaraharjo@gmail.com',
            'password' => bcrypt('agrosida2024'),
            'role_id' => 1,
            'address_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
