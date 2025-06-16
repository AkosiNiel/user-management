<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class AdminUsersSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $user = User::create([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        if (method_exists($user, 'profile')) {
            $user->profile()->create([
                'firstname'       => $faker->firstName(),
                'lastname'        => $faker->lastName(),
                'middlename'      => $faker->firstName(),
                'address'         => $faker->address(),
                'company'         => $faker->company(),
                'contact_number'  => $faker->numerify('09#########'),
                'position'        => $faker->jobTitle(),
            ]);
        }
    }
}
