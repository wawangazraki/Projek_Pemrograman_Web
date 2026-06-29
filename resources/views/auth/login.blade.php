@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #1e5a96 0%, #2d7fbd 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-lg">
                    <div class="card-body p-5">
                        <!-- Logo -->
                        <div class="text-center mb-4">
                            <div style="font-size: 3rem; color: #1e5a96; margin-bottom: 10px;">
                                <i class="fas fa-coin"></i>
                            </div>
                            <h2 class="h3" style="color: #1e5a96; font-weight: 700;">Koperasi Permata</h2>
                            <p class="text-muted">Sistem Informasi Keuangan</p>
                        </div>

                        <!-- Form -->
                        <form action="{{ route('login') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       id="password" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Ingat saya</label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mb-3" style="background-color: #1e5a96; border-color: #1e5a96;">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </button>
                        </form>

                        <!-- Info Demo -->
                        <hr>
                        <div class="alert alert-info mb-0" style="font-size: 0.9rem;">
                            <strong>Demo Login:</strong><br>
                            Email: <code>admin@koperasi.local</code><br>
                            Password: <code>password</code>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-3">
                    <a href="{{ route('home') }}" class="text-white">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
