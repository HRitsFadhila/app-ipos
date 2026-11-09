<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Budi Santoso (Kasir)',
            'email' => 'kasir@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'cashier',
        ]);

        User::create([
            'name' => 'Harits Fadhila (Owner)',
            'email' => 'owner@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'owner',
        ]);
    }
}
