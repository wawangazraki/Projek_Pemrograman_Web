<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Sistem Keuangan Koperasi Permata</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #1e5a96;
            --secondary-color: #2d7fbd;
        }
        
        body {
            background-color: #f5f5f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.3rem;
            letter-spacing: 0.5px;
        }
        
        .sidebar {
            background-color: #fff;
            border-right: 1px solid #e0e0e0;
            min-height: calc(100vh - 70px);
            padding: 20px 0;
        }
        
        .sidebar .nav-link {
            color: #333;
            padding: 12px 20px;
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
        }
        
        .sidebar .nav-link:hover {
            background-color: #f8f9fa;
            border-left-color: var(--primary-color);
            color: var(--primary-color);
        }
        
        .sidebar .nav-link.active {
            background-color: #f0f7ff;
            border-left-color: var(--primary-color);
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .main-content {
            padding: 20px;
        }
        
        .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border-radius: 8px 8px 0 0 !important;
            border: none;
            padding: 15px 20px;
            font-weight: 600;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .btn-sm {
            padding: 0.35rem 0.6rem;
            font-size: 0.85rem;
        }
        
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }
        
        .badge {
            padding: 0.5rem 0.75rem;
        }
        
        .stat-card {
            border-radius: 8px;
            padding: 20px;
            color: white;
            margin-bottom: 20px;
        }
        
        .stat-card.masuk {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }
        
        .stat-card.keluar {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }
        
        .stat-card.saldo {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        }
        
        .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 10px 0;
        }
        
        .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }
        
        .alert {
            border: none;
            border-radius: 8px;
        }
        
        .pagination {
            margin-top: 20px;
        }
        
        .footer {
            background-color: var(--primary-color);
            color: white;
            padding: 20px 0;
            margin-top: 40px;
            text-align: center;
        }
        
        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 20px;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 10px;
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-coin me-2"></i>Koperasi Permata
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user me-2"></i>{{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item" type="submit">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    @auth
        <div class="container-fluid" style="margin-top: 20px;">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-md-3 col-lg-2">
                    <div class="sidebar">
                        <nav class="nav flex-column">
                            <a class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                <i class="fas fa-chart-line me-2"></i>Dashboard
                            </a>
                            <a class="nav-link {{ Route::is('kas-masuk.*') ? 'active' : '' }}" href="{{ route('kas-masuk.index') }}">
                                <i class="fas fa-arrow-down me-2" style="color: #10b981;"></i>Kas Masuk
                            </a>
                            <a class="nav-link {{ Route::is('kas-keluar.*') ? 'active' : '' }}" href="{{ route('kas-keluar.index') }}">
                                <i class="fas fa-arrow-up me-2" style="color: #ef4444;"></i>Kas Keluar
                            </a>
                            <a class="nav-link {{ Route::is('laporan.*') ? 'active' : '' }}" href="#laporanSubmenu" data-bs-toggle="collapse" role="button" aria-expanded="{{ Route::is('laporan.*') ? 'true' : 'false' }}">
                                <i class="fas fa-file-alt me-2"></i>Laporan
                                <i class="fas fa-chevron-down float-end" style="font-size: 0.7rem;"></i>
                            </a>
                            <div class="collapse {{ Route::is('laporan.*') ? 'show' : '' }}" id="laporanSubmenu" style="padding-left: 20px; margin-top: 5px;">
                                <a class="nav-link {{ Route::is('laporan.jurnal-umum') ? 'active' : '' }}" href="{{ route('laporan.jurnal-umum') }}" style="font-size: 0.95rem;">
                                    <i class="fas fa-list me-2"></i>Jurnal Umum
                                </a>
                                <a class="nav-link {{ Route::is('laporan.buku-besar') ? 'active' : '' }}" href="{{ route('laporan.buku-besar') }}" style="font-size: 0.95rem;">
                                    <i class="fas fa-book me-2"></i>Buku Besar
                                </a>
                                <a class="nav-link {{ Route::is('laporan.neraca') ? 'active' : '' }}" href="{{ route('laporan.neraca') }}" style="font-size: 0.95rem;">
                                    <i class="fas fa-balance-scale me-2"></i>Neraca
                                </a>
                                <a class="nav-link {{ Route::is('laporan.laba-rugi') ? 'active' : '' }}" href="{{ route('laporan.laba-rugi') }}" style="font-size: 0.95rem;">
                                    <i class="fas fa-chart-pie me-2"></i>Laba/Rugi
                                </a>
                            </div>
                            <hr>
                            <a class="nav-link" href="{{ route('tentang') }}">
                                <i class="fas fa-info-circle me-2"></i>Tentang
                            </a>
                        </nav>
                    </div>
                </div>
                
                <!-- Main Content -->
                <div class="col-md-9 col-lg-10">
                    <div class="main-content">
                        <!-- Flash Messages -->
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        
                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        
                        <!-- Validation Errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Terjadi kesalahan!</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        
                        <!-- Page Content -->
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Non-authenticated view -->
        @yield('content')
    @endauth

    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container-fluid">
            <p class="mb-0">&copy; 2024 Koperasi Permata. Sistem Informasi Keuangan</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    @yield('scripts')
</body>
</html>