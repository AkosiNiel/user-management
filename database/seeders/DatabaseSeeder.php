<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
<<<<<<< HEAD
    
     //admin seeder  
public function run(): void
{
    $this->call([
        AdminUsersSeeder::class,
    ]);
}

    //superadmin seeder
    public function run(): void
{
    $this->call([
        SuperAdminSeeder::class,
    ]);
}
=======
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
>>>>>>> 973fba8 (changes)
}
