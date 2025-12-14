<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DataAccessUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Data Access User',
            'email' => 'dataaccess@example.com',
            'password' => Hash::make('password'),
            'nama_umkm' => 'Data Access UMKM',
            'address' => 'Jl. Data Access No.1',
            'city' => 'Data City',
            'province' => 'Data Province',
            'establish_year' => 2023,
            'admin' => false,
            'data_access' => true,
            'pembina_id' => null,
            'status_pembina' => false,
        ]);
    }
}