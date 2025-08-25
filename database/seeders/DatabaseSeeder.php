<?php

namespace Database\Seeders;

use App\Models\Admin;
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
            'service_id'        =>  Service::create([
                'name' => "service communication"
            ]),
            'name'              => 'Test User',
            'email'             => 'test@gmail.com',
            'type'              => 'moderator',
            'password'          => Hash::make('password'),
            'email_verified_at' => now()
        ]);

        Admin::factory()->create([
            'name'              => 'Admin User',
            'email'             => 'admin@gmail.com',
            'password'          => Hash::make('password'),
            'email_verified_at' => now()
        ]);

        Service::factory()->create([
            'name' => "service informatique"
        ]);
    }
}
