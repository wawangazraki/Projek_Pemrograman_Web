<?php

/*
 * database/seeders/UserSeeder.php
 * Seeder untuk membuat data user default
 */

namespace Database\Seeders;

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
        // Create admin user
        User::create([
            'name' => 'Admin Koperasi',
            'email' => 'admin@koperasi.local',
            'password' => Hash::make('password'),
            'role' => User::ROLE_ADMIN,
        ]);

        // Create bendahara user
        User::create([
            'name' => 'Bendahara Koperasi',
            'email' => 'bendahara@koperasi.local',
            'password' => Hash::make('password'),
            'role' => User::ROLE_BENDAHARA,
        ]);

        // Create regular user
        User::create([
            'name' => 'Pengguna Biasa',
            'email' => 'pengguna@koperasi.local',
            'password' => Hash::make('password'),
            'role' => User::ROLE_PENGGUNA,
        ]);
    }
}
