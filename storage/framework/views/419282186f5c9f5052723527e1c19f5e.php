<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>
<div style="background: linear-gradient(135deg, #1e5a96 0%, #2d7fbd 100%); color: white; padding: 60px 0; text-align: center;">
    <div class="container">
        <h1 class="display-4 fw-bold mb-4">
            <i class="fas fa-coin me-3"></i>Koperasi Permata
        </h1>
        <p class="lead mb-4">Sistem Informasi Keuangan Koperasi</p>
        
        <?php if(auth()->guard()->check()): ?>
            <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-light btn-lg me-2">
                <i class="fas fa-chart-line me-2"></i>Dashboard
            </a>
        <?php else: ?>
            <a href="<?php echo e(route('login')); ?>" class="btn btn-light btn-lg me-2">
                <i class="fas fa-sign-in-alt me-2"></i>Login
            </a>
            <a href="<?php echo e(route('tentang')); ?>" class="btn btn-outline-light btn-lg">
                <i class="fas fa-info-circle me-2"></i>Tentang Koperasi
            </a>
        <?php endif; ?>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <i class="fas fa-chart-pie" style="font-size: 2.5rem; color: #1e5a96; margin-bottom: 15px;"></i>
                    <h5 class="card-title">Dashboard</h5>
                    <p class="card-text">Pantau laporan keuangan secara real-time</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <i class="fas fa-exchange-alt" style="font-size: 2.5rem; color: #1e5a96; margin-bottom: 15px;"></i>
                    <h5 class="card-title">Transaksi</h5>
                    <p class="card-text">Catat kas masuk dan kas keluar dengan mudah</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <i class="fas fa-file-alt" style="font-size: 2.5rem; color: #1e5a96; margin-bottom: 15px;"></i>
                    <h5 class="card-title">Laporan</h5>
                    <p class="card-text">Buat laporan keuangan otomatis dengan akurat</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Project_Koperasi\resources\views/index.blade.php ENDPATH**/ ?>