
<?php $__env->startSection('title', 'Detail Pembelian'); ?>
<?php $__env->startSection('content'); ?>
<div class="card shadow-sm">
    <div class="card-header bg-light">
        <strong>Detail Nota: <?php echo e($pembelian->id_pembelian); ?></strong>
        <span class="float-end"><?php echo e($pembelian->tgl_pembelian); ?></span>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-6">
                <h6 class="fw-bold">Dari Supplier:</h6>
                <p><?php echo e($pembelian->supplier->nama_supplier); ?><br>
                   <?php echo e($pembelian->supplier->alamat); ?></p>
            </div>
            <div class="col-6 text-end">
                <h6 class="fw-bold">Penerima (Admin):</h6>
                <p><?php echo e($pembelian->pegawai->nama_pegawai); ?></p>
            </div>
        </div>

        <table class="table table-bordered">
            <thead class="table-secondary">
                <tr>
                    <th>Nama Barang</th>
                    <th>Harga Beli</th>
                    <th>Qty Masuk</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $pembelian->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($detail->barang->nama_barang); ?></td>
                    <td>Rp <?php echo e(number_format($detail->harga_beli_satuan)); ?></td>
                    <td><?php echo e($detail->jumlah_beli); ?></td>
                    <td class="text-end">Rp <?php echo e(number_format($detail->harga_beli_satuan * $detail->jumlah_beli)); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tr class="fw-bold fs-5">
                    <td colspan="3" class="text-end">TOTAL</td>
                    <td class="text-end">Rp <?php echo e(number_format($pembelian->total_biaya)); ?></td>
                </tr>
            </tbody>
        </table>

        <a href="<?php echo e(route('pembelian.index')); ?>" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\transaksi\resources\views/pembelian/show.blade.php ENDPATH**/ ?>