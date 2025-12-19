

<?php $__env->startSection('title', 'Tambah Barang Baru'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="m-0"><i class="fas fa-box me-2"></i> Form Input Barang</h5>
                </div>
                <div class="card-body p-4">
                    
                    
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('barang.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        
                        <div class="mb-3">
                            <label class="form-label">ID Barang</label>
                            <input type="text" name="id_barang" class="form-control" value="<?php echo e(old('id_barang')); ?>" placeholder="Contoh: BRG001" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Barang (ID)</label>
                            <input type="text" name="id_jenis_barang" class="form-control" value="<?php echo e(old('id_jenis_barang')); ?>" placeholder="Contoh: ATK / ELEKTRONIK" required>
                            <div class="form-text">Pastikan kode jenis barang sesuai referensi.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" value="<?php echo e(old('nama_barang')); ?>" placeholder="Contoh: Buku Tulis Sidu" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Harga Beli</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="harga_beli" class="form-control" value="<?php echo e(old('harga_beli')); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Harga Jual</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="harga_jual" class="form-control" value="<?php echo e(old('harga_jual')); ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Stok Awal</label>
                            <input type="number" name="stok_barang" class="form-control" value="<?php echo e(old('stok_barang')); ?>" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?php echo e(route('barang.index')); ?>" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-success"><i class="fas fa-save me-1"></i> Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\transaksi\resources\views/barang/create.blade.php ENDPATH**/ ?>