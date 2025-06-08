<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Property;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

       // User::factory()->create([
           // 'name' => 'Admin User',
            //'email' => 'admin@example.com',
            //'password' => Hash::make('password'), // Use a simple password for testing
            //'role' => 'admin',
        //]);

        //User::factory(5)->create();

        
        Property::factory(8)->create();
    }
}
