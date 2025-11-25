<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'password' => 'test12345',
            'role' => 'customer',
        ]);

        User::factory()->create([
            'name' => 'Test1 User',
            'email' => 'test1@gmail.com',
            'password' => 'test12345',
            'role' => 'customer',
        ]);

        User::factory()->create([
            'name' => 'Rider',
            'email' => 'rider@gmail.com',
            'password' => 'test12345',
            'role' => 'rider',
        ]);


        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => 'admin12345',
            'role' => 'admin',
        ]);
    }
}
