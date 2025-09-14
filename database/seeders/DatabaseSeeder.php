<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\User;
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

        User::factory()->create([
            'service_id'        =>  NULL,
            'name'              => 'Ray Admin',
            'email'             => 'admin@gmail.com',
            'role'              => 'admin',
            'password'          => Hash::make('password'),
            'email_verified_at' => now()
        ]);

        User::factory(4)->create([
            'role'              => 'moderator',
        ]); 
    }
}
