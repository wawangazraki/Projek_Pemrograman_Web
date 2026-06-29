@extends('layouts.app')
@section('title', 'Buku Besar')
@section('content')
<h1 class="section-title"><i class="fas fa-list me-2"></i>Buku Besar</h1>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" class="row g-2">
            <div class="col-md-4">
                <select name="akun_id" class="form-control">
                    <option value="">-- Pilih Akun --</option>
                    @foreach($akuns as $akun)
                        <option value="{{ $akun->id }}" @if($akun->id == $selectedAkun?->id) selected @endif>{{ $akun->nama_akun }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <input type="month" name="bulan" class="form-control" value="{{ $bulan }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($selectedAkun)
            <h5>{{ $selectedAkun->nama_akun }} ({{ $selectedAkun->kode_akun }})</h5>
            <hr>
        @endif
        
        @if($transactions->count() > 0)
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Kode</th>
                            <th>Deskripsi</th>
                            <th style="text-align: right;">Debit</th>
                            <th style="text-align: right;">Kredit</th>
                            <th style="text-align: right;">Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactionsWithSaldo as $tx)
                            <tr>
                                <td>{{ $tx->tanggal->format('d/m/Y') }}</td>
                                <td><small class="badge bg-secondary">{{ $tx->kode_transaksi }}</small></td>
                                <td>{{ $tx->deskripsi }}</td>
                                <td style="text-align: right;">{{ $tx->jenis === 'masuk' ? number_format($tx->jumlah, 0, ',', '.') : '-' }}</td>
                                <td style="text-align: right;">{{ $tx->jenis === 'keluar' ? number_format($tx->jumlah, 0, ',', '.') : '-' }}</td>
                                <td style="text-align: right;"><strong>{{ number_format($tx->saldo_running, 0, ',', '.') }}</strong></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $transactions->links() }}
        @else
            <p class="text-center text-muted">Tidak ada data</p>
        @endif
    </div>
</div>
@endsection
