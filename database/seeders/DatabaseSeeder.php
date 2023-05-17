<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'shmuel',
             'email' => 'shmuel@contracts.com',
             'password' => Hash::make('password'),
             'phone' => '0544570150',
             'user_type' => '0',
             'logo_url' => '',
             'comp_id' => '1',
             'comp_name' => 'shmuel company',
             'comp_email' => 'adler.shmuel@contracts.com',
             'comp_phone' => '0544570150',
             'comp_address' => 'bareket 28 harish',
         ]);
    }
}
