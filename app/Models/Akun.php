<?php

/*
 * app/Models/Akun.php
 * Model untuk Rekening/Akun dalam struktur Chart of Accounts (CoA)
 * Digunakan untuk struktur akuntansi dan laporan keuangan
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Akun extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'akuns';

    // Kolom yang bisa di-assign
    protected $fillable = [
        'kode_akun',
        'nama_akun',
        'tipe_akun',
        'kategori',
        'saldo_normal',
        'parent_id'
    ];

    // Konstanta untuk tipe akun
    const TIPE_AKTIVA = 'aktiva';
    const TIPE_KEWAJIBAN = 'kewajiban';
    const TIPE_MODAL = 'modal';
    const TIPE_PENDAPATAN = 'pendapatan';
    const TIPE_BEBAN = 'beban';

    /**
     * Relasi ke transaksi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Relasi parent untuk hierarchical chart of accounts
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Akun::class, 'parent_id');
    }

    /**
     * Relasi child untuk hierarchical chart of accounts
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(Akun::class, 'parent_id');
    }

    /**
     * Menghitung saldo akun
     * Saldo dihitung dari total transaksi
     *
     * @return decimal
     */
    public function hitungSaldo()
    {
        $debit = $this->transactions()->where('jenis', 'masuk')->sum('jumlah');
        $kredit = $this->transactions()->where('jenis', 'keluar')->sum('jumlah');

        if ($this->saldo_normal == 'debit') {
            return $debit - $kredit;
        }

        return $kredit - $debit;
    }

    /**
     * Scope untuk filter aktiva
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAktiva($query)
    {
        return $query->where('tipe_akun', self::TIPE_AKTIVA);
    }

    /**
     * Scope untuk filter kewajiban
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeKewajiban($query)
    {
        return $query->where('tipe_akun', self::TIPE_KEWAJIBAN);
    }

    /**
     * Scope untuk filter modal
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeModal($query)
    {
        return $query->where('tipe_akun', self::TIPE_MODAL);
    }

    /**
     * Scope untuk filter pendapatan
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePendapatan($query)
    {
        return $query->where('tipe_akun', self::TIPE_PENDAPATAN);
    }

    /**
     * Scope untuk filter beban
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBeban($query)
    {
        return $query->where('tipe_akun', self::TIPE_BEBAN);
    }
}
