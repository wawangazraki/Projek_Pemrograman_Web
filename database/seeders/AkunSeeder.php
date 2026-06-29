<?php

/*
 * database/seeders/AkunSeeder.php
 * Seeder untuk membuat Chart of Accounts (CoA) default
 * Berdasarkan standar akuntansi untuk koperasi
 */

namespace Database\Seeders;

use App\Models\Akun;
use Illuminate\Database\Seeder;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Akun-akun Aktiva (Asset)
        Akun::create([
            'kode_akun' => '1101',
            'nama_akun' => 'Kas',
            'tipe_akun' => Akun::TIPE_AKTIVA,
            'kategori' => 'Kas',
            'saldo_normal' => 'debit',
        ]);

        Akun::create([
            'kode_akun' => '1102',
            'nama_akun' => 'Bank',
            'tipe_akun' => Akun::TIPE_AKTIVA,
            'kategori' => 'Bank',
            'saldo_normal' => 'debit',
        ]);

        Akun::create([
            'kode_akun' => '1201',
            'nama_akun' => 'Piutang Anggota',
            'tipe_akun' => Akun::TIPE_AKTIVA,
            'kategori' => 'Piutang',
            'saldo_normal' => 'debit',
        ]);

        Akun::create([
            'kode_akun' => '1301',
            'nama_akun' => 'Inventaris',
            'tipe_akun' => Akun::TIPE_AKTIVA,
            'kategori' => 'Inventaris',
            'saldo_normal' => 'debit',
        ]);

        // Akun-akun Kewajiban (Liability)
        Akun::create([
            'kode_akun' => '2101',
            'nama_akun' => 'Hutang Usaha',
            'tipe_akun' => Akun::TIPE_KEWAJIBAN,
            'kategori' => 'Hutang',
            'saldo_normal' => 'kredit',
        ]);

        Akun::create([
            'kode_akun' => '2102',
            'nama_akun' => 'Hutang Bank',
            'tipe_akun' => Akun::TIPE_KEWAJIBAN,
            'kategori' => 'Hutang',
            'saldo_normal' => 'kredit',
        ]);

        Akun::create([
            'kode_akun' => '2201',
            'nama_akun' => 'Simpanan Anggota - Wajib',
            'tipe_akun' => Akun::TIPE_KEWAJIBAN,
            'kategori' => 'Simpanan',
            'saldo_normal' => 'kredit',
        ]);

        Akun::create([
            'kode_akun' => '2202',
            'nama_akun' => 'Simpanan Anggota - Sukarela',
            'tipe_akun' => Akun::TIPE_KEWAJIBAN,
            'kategori' => 'Simpanan',
            'saldo_normal' => 'kredit',
        ]);

        // Akun-akun Modal (Equity)
        Akun::create([
            'kode_akun' => '3101',
            'nama_akun' => 'Modal Awal',
            'tipe_akun' => Akun::TIPE_MODAL,
            'kategori' => 'Modal',
            'saldo_normal' => 'kredit',
        ]);

        Akun::create([
            'kode_akun' => '3102',
            'nama_akun' => 'Laba Ditahan',
            'tipe_akun' => Akun::TIPE_MODAL,
            'kategori' => 'Modal',
            'saldo_normal' => 'kredit',
        ]);

        // Akun-akun Pendapatan (Revenue)
        Akun::create([
            'kode_akun' => '4101',
            'nama_akun' => 'Pendapatan Bunga Pinjaman',
            'tipe_akun' => Akun::TIPE_PENDAPATAN,
            'kategori' => 'Pendapatan Utama',
            'saldo_normal' => 'kredit',
        ]);

        Akun::create([
            'kode_akun' => '4102',
            'nama_akun' => 'Pendapatan Denda',
            'tipe_akun' => Akun::TIPE_PENDAPATAN,
            'kategori' => 'Pendapatan Lain',
            'saldo_normal' => 'kredit',
        ]);

        Akun::create([
            'kode_akun' => '4201',
            'nama_akun' => 'Pendapatan Layanan',
            'tipe_akun' => Akun::TIPE_PENDAPATAN,
            'kategori' => 'Pendapatan Lain',
            'saldo_normal' => 'kredit',
        ]);

        // Akun-akun Beban (Expense)
        Akun::create([
            'kode_akun' => '5101',
            'nama_akun' => 'Beban Gaji',
            'tipe_akun' => Akun::TIPE_BEBAN,
            'kategori' => 'Beban Operasional',
            'saldo_normal' => 'debit',
        ]);

        Akun::create([
            'kode_akun' => '5102',
            'nama_akun' => 'Beban Listrik',
            'tipe_akun' => Akun::TIPE_BEBAN,
            'kategori' => 'Beban Operasional',
            'saldo_normal' => 'debit',
        ]);

        Akun::create([
            'kode_akun' => '5103',
            'nama_akun' => 'Beban Telepon',
            'tipe_akun' => Akun::TIPE_BEBAN,
            'kategori' => 'Beban Operasional',
            'saldo_normal' => 'debit',
        ]);

        Akun::create([
            'kode_akun' => '5104',
            'nama_akun' => 'Beban Pemeliharaan',
            'tipe_akun' => Akun::TIPE_BEBAN,
            'kategori' => 'Beban Operasional',
            'saldo_normal' => 'debit',
        ]);

        Akun::create([
            'kode_akun' => '5201',
            'nama_akun' => 'Beban Asuransi',
            'tipe_akun' => Akun::TIPE_BEBAN,
            'kategori' => 'Beban Lain',
            'saldo_normal' => 'debit',
        ]);

        Akun::create([
            'kode_akun' => '5202',
            'nama_akun' => 'Beban Penyusutan',
            'tipe_akun' => Akun::TIPE_BEBAN,
            'kategori' => 'Beban Lain',
            'saldo_normal' => 'debit',
        ]);
    }
}
