<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'identification' => '123456789',
            'phone' => '3001234567',
            'role' => 'admin',
            'status' => true,
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123')
        ]);    

        User::create([
            'name' => 'legal User',
            'identification' => '987654321',
            'phone' => '3007654321',
            'role' => 'legal',
            'status' => true,
            'username' => 'legal',
            'email' => 'legal@example.com',
            'password' => Hash::make('password123')
        ]);

        User::create([
            'name' => 'assistant User',
            'identification' => '2468101214',
            'phone' => '3007654321',
            'role' => 'assistant',
            'status' => true,
            'username' => 'assistant',
            'email' => 'assistant@example.com',
            'password' => Hash::make('password123')
        ]);

        

        User::create([
            'name' => 'coordinator User',
            'identification' => '1412108642',
            'phone' => '3007654321',
            'role' => 'coordinator',
            'status' => true,
            'username' => 'coordinator',
            'email' => 'coordinator@example.com',
            'password' => Hash::make('password123')
        ]);
    

        User::create([
            'name' => 'adviser User',
            'identification' => '123123456456',
            'phone' => '3007654321',
            'role' => 'adviser',
            'status' => true,
            'username' => 'adviser',
            'email' => 'adviser@example.com',
            'password' => Hash::make('password123')
        ]);
    }
}