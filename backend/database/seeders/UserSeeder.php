<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserInformation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = User::create([
            "name" => "Super Admin",
            "email" => "superadmin@email.com",
            "email_verified_at" => now(),
            "password" => Hash::make("password"),
        ]);

        UserInformation::create([
            "user_id" => $superadmin->id,
            "first_name" => fake()->firstName(),
            "middle_name" => fake()->firstName(),
            "last_name" => fake()->lastName(),
        ]);
        for ($i = 0; $i < 10; $i++) {
            $user = User::factory()->create();

            UserInformation::create([
                "user_id" => $user->id,
                "first_name" => fake()->firstName(),
                "middle_name" => fake()->firstName(),
                "last_name" => fake()->lastName(),
            ]);
        }
    }
}
