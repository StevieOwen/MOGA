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
        User::updateOrCreate(
            ['email' => 'centre.moga@gmail.com'], // Ensures no duplicates if run multiple times
            [
                
                'name' => 'Mimche Yvan',
                'password' => Hash::make('Mog@Admin$123#'), // Always hash passwords!
                'email_verified_at' => now(),
            ]
        );
    }
}