<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PembinaUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Pembina User1',
            'email' => 'pembina1@example.com',
            'password' => Hash::make('pembina1'),
            'nama_umkm' => 'Pembina UMKM',
            'address' => 'Jl. Pembina No.1',
            'city' => 'Pembina City',
            'province' => 'Pembina Province',
            'establish_year' => 2023,
            'admin' => false,
            'data_access' => false,
            'pembina_id' => null, // Pembina users don't need to be supervised by someone else
            'status_pembina' => true,
        ]);

        User::create([
            'name' => 'Pembina User2',
            'email' => 'pembina2@example.com',
            'password' => Hash::make('pembina2'),
            'nama_umkm' => 'Pembina2 UMKM',
            'address' => 'Jl. Pembina No.2',
            'city' => 'Pembina City',
            'province' => 'Pembina Province',
            'establish_year' => 2020,
            'admin' => false,
            'data_access' => false,
            'pembina_id' => null, // Pembina users don't need to be supervised by someone else
            'status_pembina' => true,
        ]);
    }
}