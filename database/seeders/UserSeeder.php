<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@demo.com'],
            [
                'nama' => 'Admin Demo',
                'password' => Hash::make('password'),
                'nomorhp' => 6280000000001,
                'isAdmin' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'worker@demo.com'],
            [
                'nama' => 'Worker Demo',
                'password' => Hash::make('password'),
                'nomorhp' => 6280000000002,
                'isAdmin' => false,
            ]
        );
    }
}
