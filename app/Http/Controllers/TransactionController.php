<?php

/*
 * app/Http/Controllers/TransactionController.php
 * Controller untuk mengelola transaksi (Kas Masuk dan Kas Keluar)
 * Menggunakan CRUD operations dan Eloquent ORM
 */

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Akun;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Menampilkan halaman kas masuk
     *
     * @return \Illuminate\View\View
     */
    public function kasMasukIndex()
    {
        // Mengambil semua transaksi kas masuk dengan pagination
        $transactions = Transaction::kasMasuk()
            ->with('akun')
            ->orderBy('tanggal', 'desc')
            ->paginate(15);

        // Mengambil daftar akun untuk dropdown
        $akuns = Akun::aktiva()->get();

        return view('transactions.kas_masuk_index', [
            'transactions' => $transactions,
            'akuns' => $akuns,
        ]);
    }

    /**
     * Menampilkan halaman kas keluar
     *
     * @return \Illuminate\View\View
     */
    public function kasKeluarIndex()
    {
        // Mengambil semua transaksi kas keluar dengan pagination
        $transactions = Transaction::kasKeluar()
            ->with('akun')
            ->orderBy('tanggal', 'desc')
            ->paginate(15);

        // Mengambil daftar akun untuk dropdown
        $akuns = Akun::where('tipe_akun', 'beban')->orWhere('tipe_akun', 'kewajiban')->get();

        return view('transactions.kas_keluar_index', [
            'transactions' => $transactions,
            'akuns' => $akuns,
        ]);
    }

    /**
     * Menampilkan form tambah kas masuk
     *
     * @return \Illuminate\View\View
     */
    public function kasMasukCreate()
    {
        // Mengambil daftar akun untuk form
        $akuns = Akun::aktiva()->get();

        return view('transactions.kas_masuk_create', [
            'akuns' => $akuns,
        ]);
    }

    /**
     * Menampilkan form tambah kas keluar
     *
     * @return \Illuminate\View\View
     */
    public function kasKeluarCreate()
    {
        // Mengambil daftar akun untuk form
        $akuns = Akun::where('tipe_akun', 'beban')
            ->orWhere('tipe_akun', 'kewajiban')
            ->get();

        return view('transactions.kas_keluar_create', [
            'akuns' => $akuns,
        ]);
    }

    /**
     * Menyimpan transaksi kas masuk baru
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function kasMasukStore(Request $request)
    {
        // Validasi input
        $request->validate([
            'kode_transaksi' => 'required|unique:transactions',
            'tanggal' => 'required|date',
            'akun_id' => 'required|exists:akuns,id',
            'jumlah' => 'required|numeric|min:1',
            'deskripsi' => 'required|string',
            'catatan' => 'nullable|string',
        ], [
            'kode_transaksi.unique' => 'Kode transaksi sudah digunakan',
            'akun_id.exists' => 'Akun tidak ditemukan',
        ]);

        // Membuat transaksi baru
        Transaction::create([
            'kode_transaksi' => $request->kode_transaksi,
            'tanggal' => $request->tanggal,
            'akun_id' => $request->akun_id,
            'jumlah' => $request->jumlah,
            'deskripsi' => $request->deskripsi,
            'jenis' => 'masuk',
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('kas-masuk.index')
            ->with('success', 'Kas masuk berhasil ditambahkan');
    }

    /**
     * Menyimpan transaksi kas keluar baru
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function kasKeluarStore(Request $request)
    {
        // Validasi input
        $request->validate([
            'kode_transaksi' => 'required|unique:transactions',
            'tanggal' => 'required|date',
            'akun_id' => 'required|exists:akuns,id',
            'jumlah' => 'required|numeric|min:1',
            'deskripsi' => 'required|string',
            'catatan' => 'nullable|string',
        ]);

        // Membuat transaksi baru
        Transaction::create([
            'kode_transaksi' => $request->kode_transaksi,
            'tanggal' => $request->tanggal,
            'akun_id' => $request->akun_id,
            'jumlah' => $request->jumlah,
            'deskripsi' => $request->deskripsi,
            'jenis' => 'keluar',
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('kas-keluar.index')
            ->with('success', 'Kas keluar berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit transaksi
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Mengambil transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($id);

        // Mengambil daftar akun
        $akuns = Akun::all();

        return view('transactions.edit', [
            'transaction' => $transaction,
            'akuns' => $akuns,
        ]);
    }

    /**
     * Mengupdate transaksi
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Mengambil transaksi
        $transaction = Transaction::findOrFail($id);

        // Validasi input
        $request->validate([
            'kode_transaksi' => 'required|unique:transactions,kode_transaksi,' . $id,
            'tanggal' => 'required|date',
            'akun_id' => 'required|exists:akuns,id',
            'jumlah' => 'required|numeric|min:1',
            'deskripsi' => 'required|string',
            'catatan' => 'nullable|string',
        ]);

        // Update transaksi
        $transaction->update([
            'kode_transaksi' => $request->kode_transaksi,
            'tanggal' => $request->tanggal,
            'akun_id' => $request->akun_id,
            'jumlah' => $request->jumlah,
            'deskripsi' => $request->deskripsi,
            'catatan' => $request->catatan,
        ]);

        $routeName = $transaction->jenis === 'masuk' ? 'kas-masuk.index' : 'kas-keluar.index';

        return redirect()->route($routeName)
            ->with('success', 'Transaksi berhasil diupdate');
    }

    /**
     * Menghapus transaksi
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Mengambil transaksi
        $transaction = Transaction::findOrFail($id);

        // Menyimpan jenis untuk redirect
        $jenis = $transaction->jenis;

        // Menghapus transaksi
        $transaction->delete();

        $routeName = $jenis === 'masuk' ? 'kas-masuk.index' : 'kas-keluar.index';

        return redirect()->route($routeName)
            ->with('success', 'Transaksi berhasil dihapus');
    }

    /**
     * Mengambil kode transaksi otomatis
     *
     * @param  string  $jenis (masuk/keluar)
     * @return \Illuminate\Http\JsonResponse
     */
    public function generateKode($jenis)
    {
        // Generate kode transaksi
        $prefix = $jenis === 'masuk' ? 'KM' : 'KK';
        $date = now()->format('Ymd');

        // Cari transaksi terakhir hari ini
        $lastTransaction = Transaction::where('jenis', $jenis)
            ->whereDate('tanggal', now())
            ->orderBy('id', 'desc')
            ->first();

        $number = $lastTransaction ? ((int)substr($lastTransaction->kode_transaksi, -3)) + 1 : 1;
        $kode = $prefix . $date . str_pad($number, 3, '0', STR_PAD_LEFT);

        return $this->responseJson(true, 'Kode generated', ['kode' => $kode]);
    }
}
