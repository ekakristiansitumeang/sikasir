
<?php $__env->startSection('title', 'Cek Utilitas (SP & Function)'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    
    
    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-info text-white">
                <i class="fas fa-search me-2"></i> Cek Status Stok (SQL Function)
            </div>
            <div class="card-body">
                <p class="text-muted">Fitur ini menggunakan Stored Function <code>f_cek_stok</code> untuk mengecek status barang.</p>
                
                <form action="<?php echo e(route('utilitas.stok')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label>Pilih Barang</label>
                        <select name="id_barang" class="form-select">
                            <?php $__currentLoopData = $barangs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($b->id_barang); ?>"><?php echo e($b->nama_barang); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <button class="btn btn-info text-white w-100">Cek Status</button>
                </form>

                <?php if(session('hasil_stok')): ?>
                    <div class="alert alert-warning mt-3 text-center fw-bold">
                        <?php echo e(session('hasil_stok')); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-success text-white">
                <i class="fas fa-money-bill-wave me-2"></i> Cek Omset (SQL SP)
            </div>
            <div class="card-body">
                <p class="text-muted">Fitur ini menggunakan Stored Procedure <code>sp_cek_omset</code> untuk menghitung pendapatan.</p>
                
                <form action="<?php echo e(route('utilitas.omset')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label>Dari Tanggal</label>
                            <input type="date" name="tgl_mulai" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label>Sampai Tanggal</label>
                            <input type="date" name="tgl_selesai" class="form-control" required>
                        </div>
                    </div>
                    <button class="btn btn-success w-100">Hitung Omset</button>
                </form>

                <?php if(session('hasil_omset')): ?>
                    <div class="alert alert-success mt-3 text-center fw-bold fs-5">
                        <?php echo e(session('hasil_omset')); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\transaksi\resources\views/utilitas/index.blade.php ENDPATH**/ ?>