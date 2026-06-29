@extends('layouts.app')
@section('title', 'Tambah Kas Masuk')
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Tambah Kas Masuk Baru</div>
            <div class="card-body">
                <form action="{{ route('kas-masuk.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Kode Transaksi</label>
                        <input type="text" name="kode_transaksi" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Akun</label>
                        <select name="akun_id" class="form-control" required>
                            @foreach($akuns as $akun)
                                <option value="{{ $akun->id }}">{{ $akun->nama_akun }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah (Rp)</label>
                        <input type="number" name="jumlah" class="form-control" step="1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <input type="text" name="deskripsi" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Catatan</label>
                        <textarea name="catatan" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('kas-masuk.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
