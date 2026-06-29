<?php $__env->startSection('title', 'Buku Besar'); ?>
<?php $__env->startSection('content'); ?>
<h1 class="section-title"><i class="fas fa-list me-2"></i>Buku Besar</h1>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" class="row g-2">
            <div class="col-md-4">
                <select name="akun_id" class="form-control">
                    <option value="">-- Pilih Akun --</option>
                    <?php $__currentLoopData = $akuns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $akun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($akun->id); ?>" <?php if($akun->id == $selectedAkun?->id): ?> selected <?php endif; ?>><?php echo e($akun->nama_akun); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-3">
                <input type="month" name="bulan" class="form-control" value="<?php echo e($bulan); ?>">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <?php if($selectedAkun): ?>
            <h5><?php echo e($selectedAkun->nama_akun); ?> (<?php echo e($selectedAkun->kode_akun); ?>)</h5>
            <hr>
        <?php endif; ?>
        
        <?php if($transactions->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Kode</th>
                            <th>Deskripsi</th>
                            <th style="text-align: right;">Debit</th>
                            <th style="text-align: right;">Kredit</th>
                            <th style="text-align: right;">Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $transactionsWithSaldo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($tx->tanggal->format('d/m/Y')); ?></td>
                                <td><small class="badge bg-secondary"><?php echo e($tx->kode_transaksi); ?></small></td>
                                <td><?php echo e($tx->deskripsi); ?></td>
                                <td style="text-align: right;"><?php echo e($tx->jenis === 'masuk' ? number_format($tx->jumlah, 0, ',', '.') : '-'); ?></td>
                                <td style="text-align: right;"><?php echo e($tx->jenis === 'keluar' ? number_format($tx->jumlah, 0, ',', '.') : '-'); ?></td>
                                <td style="text-align: right;"><strong><?php echo e(number_format($tx->saldo_running, 0, ',', '.')); ?></strong></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <?php echo e($transactions->links()); ?>

        <?php else: ?>
            <p class="text-center text-muted">Tidak ada data</p>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Apps\laragon\www\Project_Koperasi\resources\views/reports/buku_besar.blade.php ENDPATH**/ ?>