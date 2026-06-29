<?php

/*
 * database/seeders/TransactionSeeder.php
 * Seeder untuk membuat data transaksi sample
 */

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\Akun;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get akuns
        $kasAkun = Akun::where('kode_akun', '1101')->first();
        $piutangAkun = Akun::where('kode_akun', '1201')->first();
        $gajiAkun = Akun::where('kode_akun', '5101')->first();
        $buketAkun = Akun::where('kode_akun', '4101')->first();

        // Transaksi kas masuk
        Transaction::create([
            'kode_transaksi' => 'KM20240115001',
            'tanggal' => now()->subDays(10)->toDateString(),
            'jenis' => 'masuk',
            'akun_id' => $kasAkun->id,
            'jumlah' => 5000000,
            'deskripsi' => 'Setoran Simpanan Anggota',
            'catatan' => 'Setoran simpanan wajib bulan Januari',
        ]);

        Transaction::create([
            'kode_transaksi' => 'KM20240115002',
            'tanggal' => now()->subDays(9)->toDateString(),
            'jenis' => 'masuk',
            'akun_id' => $kasAkun->id,
            'jumlah' => 3500000,
            'deskripsi' => 'Angsuran Pinjaman',
            'catatan' => 'Pembayaran angsuran pinjaman Andi',
        ]);

        Transaction::create([
            'kode_transaksi' => 'KM20240115003',
            'tanggal' => now()->subDays(8)->toDateString(),
            'jenis' => 'masuk',
            'akun_id' => $kasAkun->id,
            'jumlah' => 2000000,
            'deskripsi' => 'Pendapatan Bunga',
            'catatan' => 'Bunga pinjaman bulanan',
        ]);

        // Transaksi kas keluar
        Transaction::create([
            'kode_transaksi' => 'KK20240115001',
            'tanggal' => now()->subDays(7)->toDateString(),
            'jenis' => 'keluar',
            'akun_id' => $gajiAkun->id,
            'jumlah' => 2500000,
            'deskripsi' => 'Gaji Karyawan',
            'catatan' => 'Gaji karyawan bulan Januari',
        ]);

        Transaction::create([
            'kode_transaksi' => 'KK20240115002',
            'tanggal' => now()->subDays(6)->toDateString(),
            'jenis' => 'keluar',
            'akun_id' => $gajiAkun->id,
            'jumlah' => 500000,
            'deskripsi' => 'Beban Listrik',
            'catatan' => 'Tagihan listrik kantor',
        ]);

        Transaction::create([
            'kode_transaksi' => 'KK20240115003',
            'tanggal' => now()->subDays(5)->toDateString(),
            'jenis' => 'keluar',
            'akun_id' => $gajiAkun->id,
            'jumlah' => 300000,
            'deskripsi' => 'Beban Pemeliharaan',
            'catatan' => 'Pemeliharaan gedung koperasi',
        ]);

        // Lebih banyak transaksi untuk demo
        for ($i = 0; $i < 10; $i++) {
            Transaction::create([
                'kode_transaksi' => 'KM20240120' . str_pad($i + 4, 3, '0', STR_PAD_LEFT),
                'tanggal' => now()->subDays(4 - $i)->toDateString(),
                'jenis' => 'masuk',
                'akun_id' => $kasAkun->id,
                'jumlah' => rand(1000000, 5000000),
                'deskripsi' => 'Penerimaan Kas',
                'catatan' => 'Penerimaan dari anggota nomor ' . ($i + 1),
            ]);
        }
    }
}
