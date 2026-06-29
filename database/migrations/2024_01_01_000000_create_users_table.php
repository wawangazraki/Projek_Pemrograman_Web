<?php

/*
 * database/migrations/2024_01_01_000000_create_users_table.php
 * Migration untuk membuat tabel users
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('pengguna'); // admin, bendahara, pengguna
            $table->rememberToken();
            $table->timestamps();
        });

        // Membuat index pada email untuk performa query
        Schema::table('users', function (Blueprint $table) {
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
