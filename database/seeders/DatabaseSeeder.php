<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Check if admin exists to avoid duplicates if run multiple times
        if (! User::where('email', 'admin@admin.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => 'password',
                'email_verified_at' => now(),
                'role' => 'admin',
                'subscription_status' => 'premium',
                'subscription_expires_at' => now()->addYears(10),
            ]);
        }

        // Also ensure the test user exists if needed
        if (! User::where('email', 'test@example.com')->exists()) {
            User::create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => 'password',
                'role' => 'user',
                'subscription_status' => 'free',
            ]);
        }

        // Create a test creator
        if (! User::where('email', 'creator@test.com')->exists()) {
            User::create([
                'name' => 'Test Creator',
                'email' => 'creator@test.com',
                'password' => 'password',
                'role' => 'creator',
                'subscription_status' => 'premium',
                'subscription_expires_at' => now()->addYear(),
            ]);
        }
    }
}
