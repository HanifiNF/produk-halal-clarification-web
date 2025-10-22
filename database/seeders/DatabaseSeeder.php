<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Test user 1',
            'email' => 'testuser1@gmail.com',
            'password' => Hash::make('testuser1'),
            'admin' => false,
            'data_access' => false,
        ]);

        User::create([
            'name' => 'Test user 2',
            'email' => 'testuser2@gmail.com',
            'password' => Hash::make('testuser2'),
            'admin' => false,
            'data_access' => false,
        ]);

        $this->call(AdminUserSeeder::class);
    }
}
