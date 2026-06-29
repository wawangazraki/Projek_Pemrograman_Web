<?php

/*
 * app/Http/Controllers/ReportController.php
 * Controller untuk menampilkan laporan keuangan:
 * - Jurnal Umum
 * - Buku Besar
 * - Neraca
 * - Laporan Laba/Rugi
 */

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Menampilkan laporan Jurnal Umum
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function jurnalUmum(Request $request)
    {
        // Get filter parameters
        $bulan = $request->get('bulan', now()->format('Y-m'));
        $dari = $request->get('dari');
        $sampai = $request->get('sampai');

        // Query dasar
        $query = Transaction::with('akun')
            ->orderBy('tanggal', 'asc')
            ->orderBy('id', 'asc');

        // Filter berdasarkan bulan atau tanggal
        if (!empty($dari) && !empty($sampai)) {
            $query->whereBetween('tanggal', [$dari, $sampai]);
        } else {
            $query->whereYear('tanggal', explode('-', $bulan)[0])
                  ->whereMonth('tanggal', explode('-', $bulan)[1]);
        }

        $transactions = $query->paginate(20);

        // Hitung total debit dan kredit
        $totalDebit = Transaction::where('jenis', 'masuk')
            ->whereBetween('tanggal', [$dari ?: null, $sampai ?: null])
            ->sum('jumlah');

        $totalKredit = Transaction::where('jenis', 'keluar')
            ->whereBetween('tanggal', [$dari ?: null, $sampai ?: null])
            ->sum('jumlah');

        return view('reports.jurnal_umum', [
            'transactions' => $transactions,
            'bulan' => $bulan,
            'dari' => $dari,
            'sampai' => $sampai,
            'totalDebit' => $totalDebit,
            'totalKredit' => $totalKredit,
        ]);
    }

    /**
     * Menampilkan laporan Buku Besar
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function bukuBesar(Request $request)
    {
        // Get filter parameters
        $akun_id = $request->get('akun_id');
        $bulan = $request->get('bulan', now()->format('Y-m'));

        // Mengambil daftar akun
        $akuns = Akun::all();

        // Query transaksi
        $query = Transaction::orderBy('tanggal', 'asc');

        if ($akun_id) {
            $query->where('akun_id', $akun_id);
        }

        // Filter bulan
        if (!empty($bulan)) {
            $query->whereYear('tanggal', explode('-', $bulan)[0])
                  ->whereMonth('tanggal', explode('-', $bulan)[1]);
        }

        $transactions = $query->with('akun')->paginate(25);

        // Get selected akun
        $selectedAkun = $akun_id ? Akun::find($akun_id) : null;

        // Hitung saldo running
        $saldoRunning = 0;
        $transactionsWithSaldo = $transactions->getCollection()->map(function ($transaction) use (&$saldoRunning) {
            if ($transaction->jenis === 'masuk') {
                $saldoRunning += $transaction->jumlah;
            } else {
                $saldoRunning -= $transaction->jumlah;
            }
            $transaction->saldo_running = $saldoRunning;
            return $transaction;
        });

        return view('reports.buku_besar', [
            'transactions' => $transactions,
            'transactionsWithSaldo' => $transactionsWithSaldo,
            'akuns' => $akuns,
            'selectedAkun' => $selectedAkun,
            'bulan' => $bulan,
        ]);
    }

    /**
     * Menampilkan laporan Neraca (Balance Sheet)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function neraca(Request $request)
    {
        $bulan = $request->get('bulan', now()->format('Y-m'));

        // Mengambil saldo akun berdasarkan tipe
        $aktiva = Akun::aktiva()->with('transactions')->get();
        $kewajiban = Akun::kewajiban()->with('transactions')->get();
        $modal = Akun::modal()->with('transactions')->get();

        // Hitung total untuk setiap kategori
        $totalAktiva = 0;
        $totalKewajiban = 0;
        $totalModal = 0;

        foreach ($aktiva as $akun) {
            $saldo = $akun->hitungSaldo();
            $akun->saldo = $saldo;
            $totalAktiva += $saldo;
        }

        foreach ($kewajiban as $akun) {
            $saldo = $akun->hitungSaldo();
            $akun->saldo = $saldo;
            $totalKewajiban += $saldo;
        }

        foreach ($modal as $akun) {
            $saldo = $akun->hitungSaldo();
            $akun->saldo = $saldo;
            $totalModal += $saldo;
        }

        $totalPassiva = $totalKewajiban + $totalModal;

        return view('reports.neraca', [
            'aktiva' => $aktiva,
            'kewajiban' => $kewajiban,
            'modal' => $modal,
            'totalAktiva' => $totalAktiva,
            'totalKewajiban' => $totalKewajiban,
            'totalModal' => $totalModal,
            'totalPassiva' => $totalPassiva,
            'bulan' => $bulan,
        ]);
    }

    /**
     * Menampilkan laporan Laba/Rugi
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function labaRugi(Request $request)
    {
        $bulan = $request->get('bulan', now()->format('Y-m'));

        // Mengambil akun pendapatan dan beban
        $pendapatan = Akun::pendapatan()->with('transactions')->get();
        $beban = Akun::beban()->with('transactions')->get();

        // Hitung total untuk setiap kategori
        $totalPendapatan = 0;
        $totalBeban = 0;

        foreach ($pendapatan as $akun) {
            $saldo = $akun->hitungSaldo();
            $akun->saldo = $saldo;
            $totalPendapatan += $saldo;
        }

        foreach ($beban as $akun) {
            $saldo = $akun->hitungSaldo();
            $akun->saldo = $saldo;
            $totalBeban += $saldo;
        }

        $labaRugi = $totalPendapatan - $totalBeban;

        return view('reports.laba_rugi', [
            'pendapatan' => $pendapatan,
            'beban' => $beban,
            'totalPendapatan' => $totalPendapatan,
            'totalBeban' => $totalBeban,
            'labaRugi' => $labaRugi,
            'bulan' => $bulan,
        ]);
    }

    /**
     * Export laporan ke PDF (placeholder)
     *
     * @param  string  $tipe
     * @return \Illuminate\Http\Response
     */
    public function export($tipe)
    {
        // Export functionality dapat ditambahkan di sini
        return response()->download('laporan_' . $tipe . '.pdf');
    }
}
