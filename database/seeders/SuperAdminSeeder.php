<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        
        if (!User::where('email', 'superadmin@example.com')->exists()) {
            User::create([
                'username' => 'superadmin',
                'email' => 'superadmin@example.com',
                'password' => bcrypt('secret1234'),
                'role' => 'superadmin',
                'status' => 'active',
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
