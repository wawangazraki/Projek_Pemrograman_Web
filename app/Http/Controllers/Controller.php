<?php

/*
 * app/Http/Controllers/Controller.php
 * Base Controller - Parent class untuk semua controller
 * Menggunakan OOP inheritance
 */

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Format rupiah
     *
     * @param  int  $nilai
     * @return string
     */
    protected function formatRupiah($nilai)
    {
        return 'Rp ' . number_format($nilai, 0, ',', '.');
    }

    /**
     * Parse nilai rupiah string ke integer
     *
     * @param  string  $nilai
     * @return int
     */
    protected function parseRupiah($nilai)
    {
        return (int) str_replace(['Rp ', '.', ','], '', $nilai);
    }

    /**
     * Format tanggal Indonesia
     *
     * @param  \DateTime  $tanggal
     * @return string
     */
    protected function formatTanggalIndonesia($tanggal)
    {
        $bulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        $hari = $tanggal->format('d');
        $bulanIndex = (int)$tanggal->format('m') - 1;
        $tahun = $tanggal->format('Y');

        return $hari . ' ' . $bulan[$bulanIndex] . ' ' . $tahun;
    }

    /**
     * Helper untuk response JSON
     *
     * @param  bool  $success
     * @param  string  $message
     * @param  mixed  $data
     * @param  int  $status
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseJson($success = true, $message = '', $data = null, $status = 200)
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data
        ], $status);
    }
}
