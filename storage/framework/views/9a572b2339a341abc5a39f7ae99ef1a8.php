<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col-md-12">
        <h1 class="section-title">
            <i class="fas fa-chart-line me-2"></i>Dashboard Keuangan
        </h1>
    </div>
</div>

<!-- Statistik Utama -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="stat-card masuk">
            <div class="stat-label">Kas Masuk Bulan Ini</div>
            <div class="stat-value"><?php echo e(number_format($totalKasMasuk, 0, ',', '.')); ?></div>
            <small>Rp</small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card keluar">
            <div class="stat-label">Kas Keluar Bulan Ini</div>
            <div class="stat-value"><?php echo e(number_format($totalKasKeluar, 0, ',', '.')); ?></div>
            <small>Rp</small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card saldo">
            <div class="stat-label">Saldo Bersih</div>
            <div class="stat-value"><?php echo e(number_format($saldoBersih, 0, ',', '.')); ?></div>
            <small>Rp</small>
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div class="row mb-4">
    <div class="col-md-12">
        <a href="<?php echo e(route('kas-masuk.create')); ?>" class="btn btn-success me-2">
            <i class="fas fa-arrow-down me-2"></i>Tambah Kas Masuk
        </a>
        <a href="<?php echo e(route('kas-keluar.create')); ?>" class="btn btn-danger me-2">
            <i class="fas fa-arrow-up me-2"></i>Tambah Kas Keluar
        </a>
        <a href="<?php echo e(route('laporan.jurnal-umum')); ?>" class="btn btn-primary">
            <i class="fas fa-file-alt me-2"></i>Lihat Laporan
        </a>
    </div>
</div>

<!-- Transaksi Terbaru -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-history me-2"></i>10 Transaksi Terakhir
            </div>
            <div class="card-body">
                <?php if($transaksiTerakhir->count() > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kode</th>
                                    <th>Deskripsi</th>
                                    <th>Akun</th>
                                    <th>Jenis</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $transaksiTerakhir; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaksi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($transaksi->tanggal->format('d/m/Y')); ?></td>
                                        <td><small class="badge bg-secondary"><?php echo e($transaksi->kode_transaksi); ?></small></td>
                                        <td><?php echo e($transaksi->deskripsi); ?></td>
                                        <td><?php echo e($transaksi->akun->nama_akun ?? '-'); ?></td>
                                        <td>
                                            <?php if($transaksi->jenis === 'masuk'): ?>
                                                <span class="badge bg-success">Masuk</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Keluar</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-end">
                                            <strong><?php echo e(number_format($transaksi->jumlah, 0, ',', '.')); ?></strong>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-center text-muted py-4">Belum ada transaksi</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Ringkasan Akun -->
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Akun Aktiva</div>
            <div class="card-body">
                <?php if($aktiva->count() > 0): ?>
                    <ul class="list-unstyled">
                        <?php $__currentLoopData = $aktiva; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $akun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="d-flex justify-content-between mb-2">
                                <span><?php echo e($akun->nama_akun); ?></span>
                                <strong><?php echo e(number_format($akun->hitungSaldo(), 0, ',', '.')); ?></strong>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php else: ?>
                    <p class="text-muted">Tidak ada akun aktiva</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Akun Kewajiban & Modal</div>
            <div class="card-body">
                <?php if($kewajiban->count() > 0 || $modal->count() > 0): ?>
                    <ul class="list-unstyled">
                        <?php $__currentLoopData = $kewajiban; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $akun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="d-flex justify-content-between mb-2">
                                <span><?php echo e($akun->nama_akun); ?></span>
                                <strong><?php echo e(number_format($akun->hitungSaldo(), 0, ',', '.')); ?></strong>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $modal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $akun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="d-flex justify-content-between mb-2">
                                <span><?php echo e($akun->nama_akun); ?></span>
                                <strong><?php echo e(number_format($akun->hitungSaldo(), 0, ',', '.')); ?></strong>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php else: ?>
                    <p class="text-muted">Tidak ada data</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Project_Koperasi\resources\views/dashboard.blade.php ENDPATH**/ ?>