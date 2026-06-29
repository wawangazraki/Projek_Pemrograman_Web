<?php $__env->startSection('title', 'Tambah Kas Masuk'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Tambah Kas Masuk Baru</div>
            <div class="card-body">
                <form action="<?php echo e(route('kas-masuk.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label class="form-label">Kode Transaksi</label>
                        <input type="text" name="kode_transaksi" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="<?php echo e(date('Y-m-d')); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Akun</label>
                        <select name="akun_id" class="form-control" required>
                            <?php $__currentLoopData = $akuns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $akun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($akun->id); ?>"><?php echo e($akun->nama_akun); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah (Rp)</label>
                        <input type="number" name="jumlah" class="form-control" step="1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <input type="text" name="deskripsi" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Catatan</label>
                        <textarea name="catatan" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?php echo e(route('kas-masuk.index')); ?>" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Apps\laragon\www\Project_Koperasi\resources\views/transactions/kas_masuk_create.blade.php ENDPATH**/ ?>