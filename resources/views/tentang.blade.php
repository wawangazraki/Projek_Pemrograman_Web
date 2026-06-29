@extends('layouts.app')

@section('title', 'Tentang Koperasi')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="section-title">
            <i class="fas fa-info-circle me-2"></i>Tentang Koperasi Permata
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h4>Profil Koperasi</h4>
                <table class="table">
                    <tr>
                        <td><strong>Nama Koperasi:</strong></td>
                        <td>{{ $data['nama'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Lokasi:</strong></td>
                        <td>{{ $data['lokasi'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Tahun Berdiri:</strong></td>
                        <td>{{ $data['tahunBerdiri'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Jumlah Anggota:</strong></td>
                        <td>{{ $data['jumlahAnggota'] }}</td>
                    </tr>
                </table>

                <hr>

                <h5>Tentang Kami</h5>
                <p>{{ $data['deskripsi'] }}</p>

                <h5 class="mt-4">Layanan Utama</h5>
                <ul>
                    <li>Simpan Pinjam</li>
                    <li>Asuransi Pinjaman</li>
                    <li>Penyewaan Aset</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Informasi Kontak</div>
            <div class="card-body">
                <p><i class="fas fa-map-marker-alt me-2"></i>Kabupaten Kuningan</p>
                <p><i class="fas fa-phone me-2"></i>Hubungi Pengurus</p>
                <p><i class="fas fa-envelope me-2"></i>koperasi@permata.local</p>
            </div>
        </div>
    </div>
</div>
@endsection
