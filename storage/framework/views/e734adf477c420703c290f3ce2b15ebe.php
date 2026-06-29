<?php $__env->startSection('title', 'Neraca'); ?>
<?php $__env->startSection('content'); ?>
<h1 class="section-title"><i class="fas fa-balance-scale me-2"></i>Neraca (Balance Sheet)</h1>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">ASET</div>
            <div class="card-body">
                <?php $__currentLoopData = $aktiva; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $akun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="d-flex justify-content-between mb-2">
                        <span><?php echo e($akun->nama_akun); ?></span>
                        <strong><?php echo e(number_format($akun->saldo, 0, ',', '.')); ?></strong>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <hr>
                <div class="d-flex justify-content-between" style="background: #f0f0f0; padding: 10px;">
                    <span><strong>TOTAL ASET</strong></span>
                    <strong><?php echo e(number_format($totalAktiva, 0, ',', '.')); ?></strong>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">PASIVA</div>
            <div class="card-body">
                <h6>Kewajiban</h6>
                <?php $__currentLoopData = $kewajiban; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $akun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="d-flex justify-content-between mb-2">
                        <span><?php echo e($akun->nama_akun); ?></span>
                        <strong><?php echo e(number_format($akun->saldo, 0, ',', '.')); ?></strong>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <hr>
                <h6>Modal</h6>
                <?php $__currentLoopData = $modal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $akun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="d-flex justify-content-between mb-2">
                        <span><?php echo e($akun->nama_akun); ?></span>
                        <strong><?php echo e(number_format($akun->saldo, 0, ',', '.')); ?></strong>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <hr>
                <div class="d-flex justify-content-between" style="background: #f0f0f0; padding: 10px;">
                    <span><strong>TOTAL PASIVA</strong></span>
                    <strong><?php echo e(number_format($totalPassiva, 0, ',', '.')); ?></strong>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Project_Koperasi\resources\views/reports/neraca.blade.php ENDPATH**/ ?>