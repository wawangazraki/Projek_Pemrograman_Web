@extends('layouts.app')
@section('title', 'Kas Keluar')
@section('content')
<div class="row mb-3">
    <div class="col-md-8">
        <h1 class="section-title"><i class="fas fa-arrow-up me-2" style="color: #ef4444;"></i>Kas Keluar</h1>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('kas-keluar.create') }}" class="btn btn-danger">
            <i class="fas fa-plus me-2"></i>Tambah Kas Keluar
        </a>
    </div>
</div>
<div class="card">
    <div class="card-body">
        @if($transactions->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Kode</th>
                            <th>Deskripsi</th>
                            <th>Akun</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $tx)
                            <tr>
                                <td>{{ $tx->tanggal->format('d/m/Y') }}</td>
                                <td><small class="badge bg-secondary">{{ $tx->kode_transaksi }}</small></td>
                                <td>{{ $tx->deskripsi }}</td>
                                <td>{{ $tx->akun->nama_akun }}</td>
                                <td class="text-end"><strong>{{ number_format($tx->jumlah, 0, ',', '.') }}</strong></td>
                                <td>
                                    <a href="{{ route('kas-keluar.edit', $tx->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('kas-keluar.destroy', $tx->id) }}" method="POST" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $transactions->links() }}
        @else
            <p class="text-center text-muted py-4">Tidak ada data kas keluar</p>
        @endif
    </div>
</div>
@endsection
