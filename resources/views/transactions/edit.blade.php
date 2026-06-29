@extends('layouts.app')
@section('title', 'Edit Transaksi')
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Edit Transaksi</div>
            <div class="card-body">
                <form action="{{ route('kas-masuk.update', $transaction->id) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Kode Transaksi</label>
                        <input type="text" name="kode_transaksi" class="form-control" value="{{ $transaction->kode_transaksi }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ $transaction->tanggal->format('Y-m-d') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Akun</label>
                        <select name="akun_id" class="form-control" required>
                            @foreach($akuns as $akun)
                                <option value="{{ $akun->id }}" @if($akun->id == $transaction->akun_id) selected @endif>{{ $akun->nama_akun }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah (Rp)</label>
                        <input type="number" name="jumlah" class="form-control" step="1" value="{{ $transaction->jumlah }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <input type="text" name="deskripsi" class="form-control" value="{{ $transaction->deskripsi }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Catatan</label>
                        <textarea name="catatan" class="form-control" rows="3">{{ $transaction->catatan }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="javascript:history.back()" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
