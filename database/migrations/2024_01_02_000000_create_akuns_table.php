<?php

/*
 * database/migrations/2024_01_02_000000_create_akuns_table.php
 * Migration untuk membuat tabel akuns (Chart of Accounts)
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
        Schema::create('akuns', function (Blueprint $table) {
            $table->id();
            $table->string('kode_akun')->unique(); // Contoh: 1101, 2101, 3101
            $table->string('nama_akun');
            $table->enum('tipe_akun', ['aktiva', 'kewajiban', 'modal', 'pendapatan', 'beban']);
            $table->string('kategori')->nullable(); // Contoh: Kas, Piutang, Inventaris
            $table->enum('saldo_normal', ['debit', 'kredit']); // Saldo normal untuk akun
            $table->unsignedBigInteger('parent_id')->nullable(); // Untuk hierarchical
            $table->timestamps();

            // Constraints
            $table->foreign('parent_id')->references('id')->on('akuns')->onDelete('set null');
            $table->index('tipe_akun');
            $table->index('kategori');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akuns');
    }
};
