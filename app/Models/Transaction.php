<?php

/*
 * app/Models/Transaction.php
 * Model abstrak untuk transaksi keuangan
 * Menggunakan inheritance - base class untuk transaksi lainnya
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'transactions';

    // Kolom yang bisa di-assign
    protected $fillable = [
        'kode_transaksi',
        'tanggal',
        'deskripsi',
        'jumlah',
        'jenis',
        'akun_id',
        'catatan'
    ];

    // Type casting
    protected $casts = [
        'tanggal' => 'date',
        'jumlah' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi ke tabel Akun
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function akun()
    {
        return $this->belongsTo(Akun::class);
    }

    /**
     * Scope untuk filter transaksi kas masuk
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeKasMasuk($query)
    {
        return $query->where('jenis', 'masuk');
    }

    /**
     * Scope untuk filter transaksi kas keluar
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeKasKeluar($query)
    {
        return $query->where('jenis', 'keluar');
    }

    /**
     * Scope untuk filter berdasarkan tanggal
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $bulan (format: YYYY-MM)
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBulan($query, $bulan)
    {
        return $query->whereYear('tanggal', explode('-', $bulan)[0])
                     ->whereMonth('tanggal', explode('-', $bulan)[1]);
    }
}
