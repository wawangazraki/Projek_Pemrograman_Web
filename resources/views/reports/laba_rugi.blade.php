@extends('layouts.app')
@section('title', 'Laporan Laba/Rugi')
@section('content')
<h1 class="section-title"><i class="fas fa-chart-bar me-2"></i>Laporan Laba/Rugi</h1>

<div class="card">
    <div class="card-body">
        <div style="max-width: 500px;">
            <h5>PENDAPATAN</h5>
            @foreach($pendapatan as $akun)
                <div class="d-flex justify-content-between mb-2">
                    <span>{{ $akun->nama_akun }}</span>
                    <span>{{ number_format($akun->saldo, 0, ',', '.') }}</span>
                </div>
            @endforeach
            <div class="d-flex justify-content-between mb-3" style="border-top: 1px solid #ccc; padding-top: 10px;">
                <span><strong>TOTAL PENDAPATAN</strong></span>
                <strong>{{ number_format($totalPendapatan, 0, ',', '.') }}</strong>
            </div>

            <h5>BEBAN</h5>
            @foreach($beban as $akun)
                <div class="d-flex justify-content-between mb-2">
                    <span>{{ $akun->nama_akun }}</span>
                    <span>{{ number_format($akun->saldo, 0, ',', '.') }}</span>
                </div>
            @endforeach
            <div class="d-flex justify-content-between mb-3" style="border-top: 1px solid #ccc; padding-top: 10px;">
                <span><strong>TOTAL BEBAN</strong></span>
                <strong>{{ number_format($totalBeban, 0, ',', '.') }}</strong>
            </div>

            <div class="d-flex justify-content-between" style="background: #d4edda; padding: 15px; border-radius: 5px;">
                <span><strong style="font-size: 1.2rem;">LABA/(RUGI) BERSIH</strong></span>
                <strong style="font-size: 1.2rem; color: @if($labaRugi >= 0) green @else red @endif;">
                    {{ number_format($labaRugi, 0, ',', '.') }}
                </strong>
            </div>
        </div>
    </div>
</div>
@endsection
