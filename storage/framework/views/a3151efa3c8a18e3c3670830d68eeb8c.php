
<?php $__env->startSection('title', 'Data Pegawai'); ?>
<?php $__env->startSection('content'); ?>
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="m-0">Data Pegawai</h5>
        <a href="<?php echo e(route('pegawai.create')); ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Pegawai</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $pegawais; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($p->id_pegawai); ?></td>
                    <td><?php echo e($p->nama_pegawai); ?></td>
                    <td><?php echo e($p->jabatan->nama_jabatan ?? '-'); ?></td>
                    <td>
                        <span class="badge <?php echo e($p->status_user == 'Aktif' ? 'bg-success' : 'bg-danger'); ?>">
                            <?php echo e($p->status_user); ?>

                        </span>
                    </td>
                    <td>
                        <a href="<?php echo e(route('pegawai.edit', $p->id_pegawai)); ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="<?php echo e(route('pegawai.destroy', $p->id_pegawai)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Hapus user ini?')">
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\transaksi\resources\views/pegawai/index.blade.php ENDPATH**/ ?>