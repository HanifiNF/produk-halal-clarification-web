<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'King',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('nipiganteng123'),
            'nama_umkm' => 'Admin UMKM',
            'address' => 'Jl. Admin No.1',
            'city' => 'Admin City',
            'province' => 'Admin Province',
            'establish_year' => 2020,
            'admin' => true,
            'data_access' => true,
        ]);
    }
}
