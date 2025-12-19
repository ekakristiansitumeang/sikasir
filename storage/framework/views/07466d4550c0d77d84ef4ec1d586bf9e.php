

<?php $__env->startSection('title', 'Data Barang'); ?>

<?php $__env->startSection('content'); ?>
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title m-0 text-muted">Kelola Stok & Harga</h5>
                <a href="<?php echo e(route('barang.create')); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Barang
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID Barang</th>
                            <th>Nama Barang</th>
                            <th>Jenis</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th class="text-center">Stok</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $barangs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($b->id_barang); ?></td>
                            <td class="fw-bold"><?php echo e($b->nama_barang); ?></td>
                            <td><?php echo e($b->id_jenis_barang); ?></td>
                            <td>Rp <?php echo e(number_format($b->harga_beli, 0, ',', '.')); ?></td>
                            <td>Rp <?php echo e(number_format($b->harga_jual, 0, ',', '.')); ?></td>
                            <td class="text-center">
                                
                                <span class="badge <?php echo e($b->stok_barang < 5 ? 'bg-danger' : 'bg-success'); ?> rounded-pill px-3">
                                    <?php echo e($b->stok_barang); ?>

                                </span>
                            </td>
                            <td class="text-center">
                                <a href="<?php echo e(route('barang.edit', $b->id_barang)); ?>" class="btn btn-sm btn-warning text-white" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <form action="<?php echo e(route('barang.destroy', $b->id_barang)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus barang ini?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="fas fa-box-open fa-2x mb-2"></i><br>
                                Belum ada data barang.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\transaksi\resources\views/barang/index.blade.php ENDPATH**/ ?>