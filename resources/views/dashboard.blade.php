@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h1 class="section-title">
            <i class="fas fa-chart-line me-2"></i>Dashboard Keuangan
        </h1>
    </div>
</div>

<!-- Statistik Utama -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="stat-card masuk">
            <div class="stat-label">Kas Masuk Bulan Ini</div>
            <div class="stat-value">{{ number_format($totalKasMasuk, 0, ',', '.') }}</div>
            <small>Rp</small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card keluar">
            <div class="stat-label">Kas Keluar Bulan Ini</div>
            <div class="stat-value">{{ number_format($totalKasKeluar, 0, ',', '.') }}</div>
            <small>Rp</small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card saldo">
            <div class="stat-label">Saldo Bersih</div>
            <div class="stat-value">{{ number_format($saldoBersih, 0, ',', '.') }}</div>
            <small>Rp</small>
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div class="row mb-4">
    <div class="col-md-12">
        <a href="{{ route('kas-masuk.create') }}" class="btn btn-success me-2">
            <i class="fas fa-arrow-down me-2"></i>Tambah Kas Masuk
        </a>
        <a href="{{ route('kas-keluar.create') }}" class="btn btn-danger me-2">
            <i class="fas fa-arrow-up me-2"></i>Tambah Kas Keluar
        </a>
        <a href="{{ route('laporan.jurnal-umum') }}" class="btn btn-primary">
            <i class="fas fa-file-alt me-2"></i>Lihat Laporan
        </a>
    </div>
</div>

<!-- Transaksi Terbaru -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-history me-2"></i>10 Transaksi Terakhir
            </div>
            <div class="card-body">
                @if($transaksiTerakhir->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kode</th>
                                    <th>Deskripsi</th>
                                    <th>Akun</th>
                                    <th>Jenis</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transaksiTerakhir as $transaksi)
                                    <tr>
                                        <td>{{ $transaksi->tanggal->format('d/m/Y') }}</td>
                                        <td><small class="badge bg-secondary">{{ $transaksi->kode_transaksi }}</small></td>
                                        <td>{{ $transaksi->deskripsi }}</td>
                                        <td>{{ $transaksi->akun->nama_akun ?? '-' }}</td>
                                        <td>
                                            @if($transaksi->jenis === 'masuk')
                                                <span class="badge bg-success">Masuk</span>
                                            @else
                                                <span class="badge bg-danger">Keluar</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <strong>{{ number_format($transaksi->jumlah, 0, ',', '.') }}</strong>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-center text-muted py-4">Belum ada transaksi</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Ringkasan Akun -->
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Akun Aktiva</div>
            <div class="card-body">
                @if($aktiva->count() > 0)
                    <ul class="list-unstyled">
                        @foreach($aktiva as $akun)
                            <li class="d-flex justify-content-between mb-2">
                                <span>{{ $akun->nama_akun }}</span>
                                <strong>{{ number_format($akun->hitungSaldo(), 0, ',', '.') }}</strong>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">Tidak ada akun aktiva</p>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Akun Kewajiban & Modal</div>
            <div class="card-body">
                @if($kewajiban->count() > 0 || $modal->count() > 0)
                    <ul class="list-unstyled">
                        @foreach($kewajiban as $akun)
                            <li class="d-flex justify-content-between mb-2">
                                <span>{{ $akun->nama_akun }}</span>
                                <strong>{{ number_format($akun->hitungSaldo(), 0, ',', '.') }}</strong>
                            </li>
                        @endforeach
                        @foreach($modal as $akun)
                            <li class="d-flex justify-content-between mb-2">
                                <span>{{ $akun->nama_akun }}</span>
                                <strong>{{ number_format($akun->hitungSaldo(), 0, ',', '.') }}</strong>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">Tidak ada data</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
