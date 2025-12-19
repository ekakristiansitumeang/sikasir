
<?php $__env->startSection('title', 'Tambah Pegawai'); ?>
<?php $__env->startSection('content'); ?>
<div class="card col-md-8 mx-auto shadow-sm">
    <div class="card-header bg-primary text-white">Tambah Pegawai Baru</div>
    <div class="card-body">
        <form action="<?php echo e(route('pegawai.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>ID Pegawai (Username Login)</label>
                    <input type="text" name="id_pegawai" class="form-control" placeholder="PEG001" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_pegawai" class="form-control" required>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Jabatan</label>
                    <select name="id_jabatan" class="form-select" required>
                        <option value="">-- Pilih Jabatan --</option>
                        <?php $__currentLoopData = $jabatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($j->id_jabatan); ?>"><?php echo e($j->nama_jabatan); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Status User</label>
                    <select name="status_user" class="form-select">
                        <option value="Aktif">Aktif</option>
                        <option value="Nonaktif">Nonaktif</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label>Password Login</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" rows="2"></textarea>
            </div>

            <button class="btn btn-success w-100">Simpan Data Pegawai</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\transaksi\resources\views/pegawai/create.blade.php ENDPATH**/ ?>