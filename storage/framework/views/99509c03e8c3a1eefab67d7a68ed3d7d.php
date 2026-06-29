<?php $__env->startSection('title', 'Laporan Laba/Rugi'); ?>
<?php $__env->startSection('content'); ?>
<h1 class="section-title"><i class="fas fa-chart-bar me-2"></i>Laporan Laba/Rugi</h1>

<div class="card">
    <div class="card-body">
        <div style="max-width: 500px;">
            <h5>PENDAPATAN</h5>
            <?php $__currentLoopData = $pendapatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $akun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="d-flex justify-content-between mb-2">
                    <span><?php echo e($akun->nama_akun); ?></span>
                    <span><?php echo e(number_format($akun->saldo, 0, ',', '.')); ?></span>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="d-flex justify-content-between mb-3" style="border-top: 1px solid #ccc; padding-top: 10px;">
                <span><strong>TOTAL PENDAPATAN</strong></span>
                <strong><?php echo e(number_format($totalPendapatan, 0, ',', '.')); ?></strong>
            </div>

            <h5>BEBAN</h5>
            <?php $__currentLoopData = $beban; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $akun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="d-flex justify-content-between mb-2">
                    <span><?php echo e($akun->nama_akun); ?></span>
                    <span><?php echo e(number_format($akun->saldo, 0, ',', '.')); ?></span>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="d-flex justify-content-between mb-3" style="border-top: 1px solid #ccc; padding-top: 10px;">
                <span><strong>TOTAL BEBAN</strong></span>
                <strong><?php echo e(number_format($totalBeban, 0, ',', '.')); ?></strong>
            </div>

            <div class="d-flex justify-content-between" style="background: #d4edda; padding: 15px; border-radius: 5px;">
                <span><strong style="font-size: 1.2rem;">LABA/(RUGI) BERSIH</strong></span>
                <strong style="font-size: 1.2rem; color: <?php if($labaRugi >= 0): ?> green <?php else: ?> red <?php endif; ?>;">
                    <?php echo e(number_format($labaRugi, 0, ',', '.')); ?>

                </strong>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Apps\laragon\www\Project_Koperasi\resources\views/reports/laba_rugi.blade.php ENDPATH**/ ?>