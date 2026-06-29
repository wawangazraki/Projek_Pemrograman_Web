<?php

/*
 * app/Models/User.php
 * Model untuk User/Pengguna aplikasi
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Nama tabel di database
    protected $table = 'users';

    // Kolom yang bisa di-assign
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    // Kolom yang tidak ditampilkan saat serialize
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Type casting
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Konstanta untuk role
    const ROLE_ADMIN = 'admin';
    const ROLE_BENDAHARA = 'bendahara';
    const ROLE_PENGGUNA = 'pengguna';

    /**
     * Cek apakah user adalah admin
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * Cek apakah user adalah bendahara
     *
     * @return bool
     */
    public function isBendahara()
    {
        return $this->role === self::ROLE_BENDAHARA;
    }

    /**
     * Cek apakah user memiliki akses ke fitur tertentu
     *
     * @param  string  $fitur
     * @return bool
     */
    public function hasAccess($fitur)
    {
        // Admin memiliki akses ke semua fitur
        if ($this->isAdmin()) {
            return true;
        }

        // Bendahara memiliki akses ke fitur keuangan
        if ($this->isBendahara() && in_array($fitur, ['kas_masuk', 'kas_keluar', 'jurnal', 'laporan'])) {
            return true;
        }

        // Pengguna biasa hanya bisa lihat laporan
        if ($this->role === self::ROLE_PENGGUNA && $fitur === 'laporan') {
            return true;
        }

        return false;
    }
}
