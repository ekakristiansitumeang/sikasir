
<?php $__env->startSection('title', 'Data Jabatan'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">Tambah Jabatan</div>
            <div class="card-body">
                <form action="<?php echo e(route('jabatan.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label>ID Jabatan</label>
                        <input type="text" name="id_jabatan" class="form-control" placeholder="JAB01" required>
                    </div>
                    <div class="mb-3">
                        <label>Nama Jabatan</label>
                        <input type="text" name="nama_jabatan" class="form-control" placeholder="Kasir / Admin" required>
                    </div>
                    <button class="btn btn-success w-100">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white">Daftar Jabatan</div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Jabatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $jabatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($j->id_jabatan); ?></td>
                            <td><?php echo e($j->nama_jabatan); ?></td>
                            <td>
                                <form action="<?php echo e(route('jabatan.destroy', $j->id_jabatan)); ?>" method="POST" onsubmit="return confirm('Hapus?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\transaksi\resources\views/jabatan/index.blade.php ENDPATH**/ ?>