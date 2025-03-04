<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Generate 10 Tenants and 10 Lessees
        $roles = ['tenant', 'lessee'];

        foreach ($roles as $role) {
            for ($i = 0; $i < 10; $i++) {
                User::create([
                    'firstname' => $faker->firstName,
                    'middlename' => $faker->randomElement([null, $faker->firstName]),
                    'lastname' => $faker->lastName,
                    'phone_number' => $faker->phoneNumber,
                    'city' => $faker->city,
                    'barangay' => $faker->streetName,
                    'street_address' => $faker->streetAddress,
                    'zipcode' => $faker->postcode,
                    'username' => $faker->userName,
                    'email' => $faker->unique()->safeEmail,
                    'email_verified_at' => now(),
                    'password' => Hash::make('password123'), // Default password: "password"
                    'role' => $role,
                    'valid_id' => null,
                    'identity_recognition' => null,
                    'avatar' => null,
                    'remember_token' => Str::random(10),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
