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
}
