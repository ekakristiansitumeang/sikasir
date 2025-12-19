

<?php $__env->startSection('title', 'Edit Data Pelanggan'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h5 class="card-title mb-4">Edit Pelanggan: <strong><?php echo e($konsumen->nama_calon_konsumen); ?></strong></h5>

                    <form action="<?php echo e(route('konsumen.update', $konsumen->id_calon_konsumen)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        
                        <div class="mb-3">
                            <label class="form-label">ID Konsumen</label>
                            <input type="text" name="id_calon_konsumen" class="form-control bg-light" value="<?php echo e($konsumen->id_calon_konsumen); ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama_calon_konsumen" class="form-control" value="<?php echo e(old('nama_calon_konsumen', $konsumen->nama_calon_konsumen)); ?>" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email_calon_konsumen" class="form-control" value="<?php echo e(old('email_calon_konsumen', $konsumen->email_calon_konsumen)); ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">ID Negara</label>
                                <input type="number" name="id_negara" class="form-control" value="<?php echo e(old('id_negara', $konsumen->id_negara)); ?>" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Tanggal Pendaftaran</label>
                            <input type="date" name="tgl_pendaftaran" class="form-control" value="<?php echo e(old('tgl_pendaftaran', $konsumen->tgl_pendaftaran)); ?>" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?php echo e(route('konsumen.index')); ?>" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-sync-alt me-1"></i> Update Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\transaksi\resources\views/konsumen/edit.blade.php ENDPATH**/ ?>