
<?php $__env->startSection('title', 'Data Jenis Barang'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">Tambah Jenis</div>
            <div class="card-body">
                <form action="<?php echo e(route('jenis.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label>ID Jenis</label>
                        <input type="text" name="id_jenis" class="form-control" placeholder="JNS01" required>
                    </div>
                    <div class="mb-3">
                        <label>Nama Jenis</label>
                        <input type="text" name="nama_jenis" class="form-control" placeholder="Elektronik" required>
                    </div>
                    <button class="btn btn-success w-100">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white">Daftar Jenis Barang</div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama Jenis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $jenis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($j->id_jenis); ?></td>
                            <td><?php echo e($j->nama_jenis); ?></td>
                            <td>
                                <form action="<?php echo e(route('jenis.destroy', $j->id_jenis)); ?>" method="POST" onsubmit="return confirm('Hapus?')">
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\transaksi\resources\views/jenis/index.blade.php ENDPATH**/ ?>