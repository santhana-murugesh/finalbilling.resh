<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Remove existing arjun user if present
        User::where('username', 'arjun')->delete();

        // Create the arjun user
        User::create([
            'name' => 'Arjun',
            'username' => 'arjun',
            'email' => 'arjun@example.com',
            'password' => Hash::make('password'),
        ]);

        // Keep the test user for development
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
