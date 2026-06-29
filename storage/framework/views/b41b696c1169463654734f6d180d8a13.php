<?php $__env->startSection('title', 'Jurnal Umum'); ?>
<?php $__env->startSection('content'); ?>
<h1 class="section-title"><i class="fas fa-book me-2"></i>Jurnal Umum</h1>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" class="row g-2">
            <div class="col-md-3">
                <input type="month" name="bulan" class="form-control" value="<?php echo e($bulan); ?>">
            </div>
            <div class="col-md-3">
                <input type="date" name="dari" class="form-control" placeholder="Dari" value="<?php echo e($dari); ?>">
            </div>
            <div class="col-md-3">
                <input type="date" name="sampai" class="form-control" placeholder="Sampai" value="<?php echo e($sampai); ?>">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <?php if($transactions->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Kode</th>
                            <th>Deskripsi</th>
                            <th>Akun</th>
                            <th style="text-align: right;">Debit</th>
                            <th style="text-align: right;">Kredit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($tx->tanggal->format('d/m/Y')); ?></td>
                                <td><small class="badge bg-secondary"><?php echo e($tx->kode_transaksi); ?></small></td>
                                <td><?php echo e($tx->deskripsi); ?></td>
                                <td><?php echo e($tx->akun->nama_akun); ?></td>
                                <td style="text-align: right;"><?php echo e($tx->jenis === 'masuk' ? number_format($tx->jumlah, 0, ',', '.') : '-'); ?></td>
                                <td style="text-align: right;"><?php echo e($tx->jenis === 'keluar' ? number_format($tx->jumlah, 0, ',', '.') : '-'); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr class="table-info">
                            <th colspan="4" style="text-align: right;">TOTAL</th>
                            <th style="text-align: right;"><?php echo e(number_format($totalDebit, 0, ',', '.')); ?></th>
                            <th style="text-align: right;"><?php echo e(number_format($totalKredit, 0, ',', '.')); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <?php echo e($transactions->links()); ?>

        <?php else: ?>
            <p class="text-center text-muted">Tidak ada data transaksi</p>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Apps\laragon\www\Project_Koperasi\resources\views/reports/jurnal_umum.blade.php ENDPATH**/ ?>