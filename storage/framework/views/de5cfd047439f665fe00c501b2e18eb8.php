<?php $__env->startSection('title', 'Kas Keluar'); ?>
<?php $__env->startSection('content'); ?>
<div class="row mb-3">
    <div class="col-md-8">
        <h1 class="section-title"><i class="fas fa-arrow-up me-2" style="color: #ef4444;"></i>Kas Keluar</h1>
    </div>
    <div class="col-md-4 text-end">
        <a href="<?php echo e(route('kas-keluar.create')); ?>" class="btn btn-danger">
            <i class="fas fa-plus me-2"></i>Tambah Kas Keluar
        </a>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <?php if($transactions->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Kode</th>
                            <th>Deskripsi</th>
                            <th>Akun</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($tx->tanggal->format('d/m/Y')); ?></td>
                                <td><small class="badge bg-secondary"><?php echo e($tx->kode_transaksi); ?></small></td>
                                <td><?php echo e($tx->deskripsi); ?></td>
                                <td><?php echo e($tx->akun->nama_akun); ?></td>
                                <td class="text-end"><strong><?php echo e(number_format($tx->jumlah, 0, ',', '.')); ?></strong></td>
                                <td>
                                    <a href="<?php echo e(route('kas-keluar.edit', $tx->id)); ?>" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="<?php echo e(route('kas-keluar.destroy', $tx->id)); ?>" method="POST" style="display:inline;">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <?php echo e($transactions->links()); ?>

        <?php else: ?>
            <p class="text-center text-muted py-4">Tidak ada data kas keluar</p>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Apps\laragon\www\Project_Koperasi\resources\views/transactions/kas_keluar_index.blade.php ENDPATH**/ ?>