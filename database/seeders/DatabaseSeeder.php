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
            'name' => 'Test User 1',
            'email' => 'Testuser@gmail.com',
            'password' => Hash::make('testuser1'),
            'nama_umkm' => 'jagung manis oguri',
            'address' => 'Jln test 1 ',
            'city' => 'test 1 City',
            'province' => 'test 1 Province',
            'establish_year' => 2020,
            'admin' => false,
            'data_access' => false,
        ]);

        User::create([
            'name' => 'Test User 2',
            'email' => 'Testuser2@gmail.com',
            'password' => Hash::make('testuser2'),
            'nama_umkm' => 'minuman segar special',
            'address' => 'Jln test 2',
            'city' => 'test 2 City',
            'province' => 'test 2 Province',
            'establish_year' => 2018,
            'admin' => false,
            'data_access' => false,
        ]);
        
        $this->call(AdminUserSeeder::class);
    }
}
