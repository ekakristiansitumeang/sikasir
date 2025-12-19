
<?php $__env->startSection('title', 'Riwayat Pembelian'); ?>
<?php $__env->startSection('content'); ?>
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="m-0">Riwayat Pengadaan (Barang Masuk)</h5>
        <a href="<?php echo e(route('pembelian.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Stok Masuk Baru
        </a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID Nota</th>
                    <th>Tanggal</th>
                    <th>Supplier</th>
                    <th>Petugas</th>
                    <th>Total Biaya</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $pembelians; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($p->id_pembelian); ?></td>
                    <td><?php echo e($p->tgl_pembelian); ?></td>
                    <td><?php echo e($p->supplier->nama_supplier ?? 'Umum'); ?></td>
                    <td><?php echo e($p->pegawai->nama_pegawai ?? '-'); ?></td>
                    <td class="fw-bold">Rp <?php echo e(number_format($p->total_biaya, 0, ',', '.')); ?></td>
                    <td>
                        <a href="<?php echo e(route('pembelian.show', $p->id_pembelian)); ?>" class="btn btn-info btn-sm text-white">Detail</a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="6" class="text-center">Belum ada data pembelian.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\transaksi\resources\views/pembelian/index.blade.php ENDPATH**/ ?>