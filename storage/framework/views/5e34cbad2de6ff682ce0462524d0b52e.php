
<?php $__env->startSection('title', 'Tambah Supplier'); ?>
<?php $__env->startSection('content'); ?>
<div class="card col-md-6 mx-auto shadow-sm">
    <div class="card-body">
        <h4>Tambah Supplier Baru</h4>
        <hr>
        <form action="<?php echo e(route('supplier.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label>ID Supplier</label>
                <input type="text" name="id_supplier" class="form-control" placeholder="SUP001" required>
            </div>
            <div class="mb-3">
                <label>Nama PT / Toko</label>
                <input type="text" name="nama_supplier" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>No Telepon</label>
                <input type="text" name="no_telp" class="form-control">
            </div>
            <div class="mb-3">
                <label>Alamat Lengkap</label>
                <textarea name="alamat" class="form-control"></textarea>
            </div>
            <button class="btn btn-success w-100">Simpan Data</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\transaksi\resources\views/supplier/create.blade.php ENDPATH**/ ?>