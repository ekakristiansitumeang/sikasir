

<?php $__env->startSection('title', 'Edit Data Barang'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h5 class="card-title mb-4">Edit Barang: <strong><?php echo e($barang->nama_barang); ?></strong></h5>

                    <form action="<?php echo e(route('barang.update', $barang->id_barang)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        
                        
                        <div class="mb-3">
                            <label class="form-label">ID Barang</label>
                            <input type="text" name="id_barang" class="form-control bg-light" value="<?php echo e($barang->id_barang); ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Barang</label>
                            <input type="text" name="id_jenis_barang" class="form-control" value="<?php echo e(old('id_jenis_barang', $barang->id_jenis_barang)); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" value="<?php echo e(old('nama_barang', $barang->nama_barang)); ?>" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Harga Beli</label>
                                <input type="number" name="harga_beli" class="form-control" value="<?php echo e(old('harga_beli', $barang->harga_beli)); ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Harga Jual</label>
                                <input type="number" name="harga_jual" class="form-control" value="<?php echo e(old('harga_jual', $barang->harga_jual)); ?>" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Stok</label>
                            <input type="number" name="stok_barang" class="form-control" value="<?php echo e(old('stok_barang', $barang->stok_barang)); ?>" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?php echo e(route('barang.index')); ?>" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-sync-alt me-1"></i> Update Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\transaksi\resources\views/barang/edit.blade.php ENDPATH**/ ?>