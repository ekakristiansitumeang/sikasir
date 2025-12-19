

<?php $__env->startSection('title', 'Ringkasan Toko'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 border-start border-4 border-success h-100">
                <div class="card-body">
                    <h6 class="text-muted text-uppercase mb-2">Omset Hari Ini</h6>
                    <h3 class="fw-bold text-success">Rp <?php echo e(number_format($omsetHariIni, 0, ',', '.')); ?></h3>
                    <small class="text-muted"><i class="far fa-calendar-alt"></i> <?php echo e(date('d M Y')); ?></small>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 border-start border-4 border-primary h-100">
                <div class="card-body">
                    <h6 class="text-muted text-uppercase mb-2">Total Transaksi</h6>
                    <h3 class="fw-bold text-primary"><?php echo e($transaksiHariIni); ?> <span class="fs-6 text-muted">Struk</span></h3>
                    <small class="text-muted">Penjualan hari ini</small>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 border-start border-4 border-warning h-100">
                <div class="card-body">
                    <h6 class="text-muted text-uppercase mb-2">Total Pelanggan</h6>
                    <h3 class="fw-bold text-warning"><?php echo e($totalKonsumen); ?> <span class="fs-6 text-muted">Orang</span></h3>
                    <small class="text-muted">Data konsumen terdaftar</small>
                </div>
            </div>
        </div>
    </div>

    
    <?php if($barangMenipis->count() > 0): ?>
        <div class="card shadow-sm border-0 border-top border-danger border-3">
            <div class="card-header bg-white py-3">
                <h5 class="m-0 text-danger"><i class="fas fa-exclamation-triangle me-2"></i> Peringatan Stok Menipis</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped m-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Barang</th>
                            <th>Sisa Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $barangMenipis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($b->nama_barang); ?></td>
                            <td><span class="badge bg-danger"><?php echo e($b->stok_barang); ?></span></td>
                            <td>
                                <a href="<?php echo e(route('barang.edit', $b->id_barang)); ?>" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-plus-circle"></i> Restock
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle me-2"></i> Stok aman! Tidak ada barang yang kurang dari 5 pcs.
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\transaksi\resources\views/dashboard/index.blade.php ENDPATH**/ ?>