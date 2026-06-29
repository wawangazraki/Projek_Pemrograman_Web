<?php

/*
 * app/Http/Controllers/HomeController.php
 * Controller untuk halaman home/index
 */

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman home
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Menampilkan halaman tentang koperasi
     *
     * @return \Illuminate\View\View
     */
    public function tentang()
    {
        $data = [
            'nama' => 'Koperasi Permata',
            'lokasi' => 'Kabupaten Kuningan',
            'tahunBerdiri' => 1972,
            'jumlahAnggota' => '±1.600 orang',
            'deskripsi' => 'Koperasi yang melayani kebutuhan simpan pinjam bagi tenaga pendidik dan aparatur sipil di Kabupaten Kuningan.'
        ];

        return view('tentang', ['data' => $data]);
    }
}
