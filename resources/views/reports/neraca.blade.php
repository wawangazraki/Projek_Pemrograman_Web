@extends('layouts.app')
@section('title', 'Neraca')
@section('content')
<h1 class="section-title"><i class="fas fa-balance-scale me-2"></i>Neraca (Balance Sheet)</h1>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">ASET</div>
            <div class="card-body">
                @foreach($aktiva as $akun)
                    <div class="d-flex justify-content-between mb-2">
                        <span>{{ $akun->nama_akun }}</span>
                        <strong>{{ number_format($akun->saldo, 0, ',', '.') }}</strong>
                    </div>
                @endforeach
                <hr>
                <div class="d-flex justify-content-between" style="background: #f0f0f0; padding: 10px;">
                    <span><strong>TOTAL ASET</strong></span>
                    <strong>{{ number_format($totalAktiva, 0, ',', '.') }}</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">PASIVA</div>
            <div class="card-body">
                <h6>Kewajiban</h6>
                @foreach($kewajiban as $akun)
                    <div class="d-flex justify-content-between mb-2">
                        <span>{{ $akun->nama_akun }}</span>
                        <strong>{{ number_format($akun->saldo, 0, ',', '.') }}</strong>
                    </div>
                @endforeach
                <hr>
                <h6>Modal</h6>
                @foreach($modal as $akun)
                    <div class="d-flex justify-content-between mb-2">
                        <span>{{ $akun->nama_akun }}</span>
                        <strong>{{ number_format($akun->saldo, 0, ',', '.') }}</strong>
                    </div>
                @endforeach
                <hr>
                <div class="d-flex justify-content-between" style="background: #f0f0f0; padding: 10px;">
                    <span><strong>TOTAL PASIVA</strong></span>
                    <strong>{{ number_format($totalPassiva, 0, ',', '.') }}</strong>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
