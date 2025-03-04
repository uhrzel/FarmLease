<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'firstname' => 'Super',
            'middlename' => null,
            'lastname' => 'Admin',
            'phone_number' => null,
            'city' => null,
            'barangay' => null,
            'street_address' => null,
            'zipcode' => null,
            'username' => 'superadmin',
            'email' => 'superadmin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('superadmin'), // Hashing password for security
            'role' => 'superadmin',
            'valid_id' => null,
            'identity_recognition' => null,
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
