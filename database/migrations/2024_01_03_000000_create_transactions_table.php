<?php

/*
 * database/migrations/2024_01_03_000000_create_transactions_table.php
 * Migration untuk membuat tabel transactions (Jurnal Umum)
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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique(); // Contoh: KM20240115001
            $table->date('tanggal');
            $table->enum('jenis', ['masuk', 'keluar']); // Jenis transaksi
            $table->unsignedBigInteger('akun_id');
            $table->string('deskripsi');
            $table->decimal('jumlah', 15, 2); // Jumlah maksimal 999 miliar
            $table->text('catatan')->nullable();
            $table->timestamps();

            // Constraints dan indexes
            $table->foreign('akun_id')->references('id')->on('akuns')->onDelete('restrict');
            $table->index('tanggal');
            $table->index('jenis');
            $table->index('akun_id');
            $table->index(['tanggal', 'jenis']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
