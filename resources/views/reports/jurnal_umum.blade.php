@extends('layouts.app')
@section('title', 'Jurnal Umum')
@section('content')
<h1 class="section-title"><i class="fas fa-book me-2"></i>Jurnal Umum</h1>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" class="row g-2">
            <div class="col-md-3">
                <input type="month" name="bulan" class="form-control" value="{{ $bulan }}">
            </div>
            <div class="col-md-3">
                <input type="date" name="dari" class="form-control" placeholder="Dari" value="{{ $dari }}">
            </div>
            <div class="col-md-3">
                <input type="date" name="sampai" class="form-control" placeholder="Sampai" value="{{ $sampai }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($transactions->count() > 0)
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Kode</th>
                            <th>Deskripsi</th>
                            <th>Akun</th>
                            <th style="text-align: right;">Debit</th>
                            <th style="text-align: right;">Kredit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $tx)
                            <tr>
                                <td>{{ $tx->tanggal->format('d/m/Y') }}</td>
                                <td><small class="badge bg-secondary">{{ $tx->kode_transaksi }}</small></td>
                                <td>{{ $tx->deskripsi }}</td>
                                <td>{{ $tx->akun->nama_akun }}</td>
                                <td style="text-align: right;">{{ $tx->jenis === 'masuk' ? number_format($tx->jumlah, 0, ',', '.') : '-' }}</td>
                                <td style="text-align: right;">{{ $tx->jenis === 'keluar' ? number_format($tx->jumlah, 0, ',', '.') : '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="table-info">
                            <th colspan="4" style="text-align: right;">TOTAL</th>
                            <th style="text-align: right;">{{ number_format($totalDebit, 0, ',', '.') }}</th>
                            <th style="text-align: right;">{{ number_format($totalKredit, 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            {{ $transactions->links() }}
        @else
            <p class="text-center text-muted">Tidak ada data transaksi</p>
        @endif
    </div>
</div>
@endsection
