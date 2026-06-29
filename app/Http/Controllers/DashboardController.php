<?php

/*
 * app/Http/Controllers/DashboardController.php
 * Controller untuk menampilkan dashboard/overview keuangan
 * Extends Controller (inheritance)
 */

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Akun;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil data untuk dashboard
        $bulanIni = now()->format('Y-m');

        // Total kas masuk bulan ini
        $totalKasMasuk = Transaction::kasMasuk()
            ->bulan($bulanIni)
            ->sum('jumlah');

        // Total kas keluar bulan ini
        $totalKasKeluar = Transaction::kasKeluar()
            ->bulan($bulanIni)
            ->sum('jumlah');

        // Saldo bersih
        $saldoBersih = $totalKasMasuk - $totalKasKeluar;

        // Data untuk grafik 10 transaksi terakhir
        $transaksiTerakhir = Transaction::orderBy('tanggal', 'desc')
            ->take(10)
            ->get();

        // Statistik per kategori
        $statistikPerKategori = Transaction::select('akun_id')
            ->where(DB::raw('DATE_FORMAT(tanggal, "%Y-%m")'), '=', $bulanIni)
            ->selectRaw('jenis, COUNT(*) as jumlah_transaksi, SUM(jumlah) as total')
            ->groupBy('akun_id', 'jenis')
            ->with('akun')
            ->get();

        // Data untuk akun-akun utama (aktiva, kewajiban, modal)
        $aktiva = Akun::aktiva()->get();
        $kewajiban = Akun::kewajiban()->get();
        $modal = Akun::modal()->get();

        return view('dashboard', [
            'totalKasMasuk' => $totalKasMasuk,
            'totalKasKeluar' => $totalKasKeluar,
            'saldoBersih' => $saldoBersih,
            'transaksiTerakhir' => $transaksiTerakhir,
            'statistikPerKategori' => $statistikPerKategori,
            'bulanIni' => $bulanIni,
            'aktiva' => $aktiva,
            'kewajiban' => $kewajiban,
            'modal' => $modal,
        ]);
    }

    /**
     * Menampilkan ringkasan kas
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ringkasanKas()
    {
        $bulanIni = now()->format('Y-m');

        $kasMasuk = Transaction::kasMasuk()
            ->bulan($bulanIni)
            ->sum('jumlah');

        $kasKeluar = Transaction::kasKeluar()
            ->bulan($bulanIni)
            ->sum('jumlah');

        $saldo = $kasMasuk - $kasKeluar;

        return $this->responseJson(true, 'Data kas berhasil diambil', [
            'kas_masuk' => $kasMasuk,
            'kas_keluar' => $kasKeluar,
            'saldo' => $saldo,
        ]);
    }
}
