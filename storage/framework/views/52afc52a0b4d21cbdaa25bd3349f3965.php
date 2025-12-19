<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran Transaksi</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        .box { border: 1px solid #ccc; padding: 20px; border-radius: 8px; max-width: 600px; margin: auto; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input, select { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; }
        .info { background: #f0f8ff; padding: 10px; margin-bottom: 20px; border-left: 5px solid blue; }
        button { background: green; color: white; padding: 10px 20px; border: none; cursor: pointer; width: 100%; margin-top: 20px; font-size: 16px; }
    </style>
</head>
<body>

    <div class="box">
        <h2>💰 Input Pembayaran</h2>
        
        
        <div class="info">
            <p><strong>ID Transaksi:</strong> <?php echo e($pemesanan->id_pemesanan); ?></p>
            <p><strong>Konsumen:</strong> <?php echo e($pemesanan->konsumen->nama_calon_konsumen ?? 'Umum'); ?></p>
            <p><strong>Total Tagihan:</strong> Rp <?php echo e(number_format($pemesanan->total_harga, 0, ',', '.')); ?></p>
        </div>

        <?php if($errors->any()): ?>
            <div style="color: red;">
                <ul><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <li><?php echo e($err); ?></li> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('pembayaran.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            
            
            <input type="hidden" name="id_pemesanan" value="<?php echo e($pemesanan->id_pemesanan); ?>">

            <label>Tanggal Bayar:</label>
            <input type="date" name="tgl_pembayaran" value="<?php echo e(date('Y-m-d')); ?>" required>

            <label>Jenis Pembayaran:</label>
            <select name="jenis_pembayaran" required>
                <option value="Tunai">Tunai</option>
                <option value="Transfer Bank">Transfer Bank</option>
                <option value="QRIS">QRIS</option>
                <option value="Kartu Debit/Kredit">Kartu Debit/Kredit</option>
            </select>

            <label>Jumlah Bayar (Rp):</label>
            
            <input type="number" name="total_pembayaran" value="<?php echo e($pemesanan->total_harga); ?>" required>

            <button type="submit">PROSES PELUNASAN</button>
        </form>
        
        <br>
        <center><a href="<?php echo e(route('pemesanan.index')); ?>">Batal</a></center>
    </div>

</body>
</html><?php /**PATH C:\laragon\www\transaksi\resources\views/pembayaran/create.blade.php ENDPATH**/ ?>