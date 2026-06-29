<?php

/*
 * database/seeders/DatabaseSeeder.php
 * Main seeder - menjalankan semua seeder lainnya
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jalankan seeder dalam urutan yang benar
        $this->call([
            UserSeeder::class,      // Buat user terlebih dahulu
            AkunSeeder::class,      // Buat chart of accounts
            TransactionSeeder::class, // Buat transaksi sample
        ]);
    }
}
