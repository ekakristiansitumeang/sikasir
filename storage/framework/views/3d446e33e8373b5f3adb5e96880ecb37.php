

<?php $__env->startSection('title', 'Kasir / Transaksi Baru'); ?>

<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('pemesanan.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>

    <div class="row">
        
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="m-0"><i class="fas fa-user-tag me-2"></i> Data Pelanggan</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilih Konsumen</label>
                        <select name="id_calon_konsumen" class="form-select" required>
                            <option value="">-- Pilih Pelanggan --</option>
                            <?php $__currentLoopData = $konsumens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($k->id_calon_konsumen); ?>">
                                    <?php echo e($k->nama_calon_konsumen); ?> (ID: <?php echo e($k->id_calon_konsumen); ?>)
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal Transaksi</label>
                        <input type="date" name="tgl_pemesanan" class="form-control" value="<?php echo e(date('Y-m-d')); ?>" required>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-md-8 mb-4">
            <div class="card shadow-sm border-0 h-100 bg-dark text-white">
                <div class="card-body d-flex flex-column justify-content-center align-items-end">
                    <h5 class="text-white-50">GRAND TOTAL</h5>
                    <h1 class="display-3 fw-bold text-success" id="grand_total_display">Rp 0</h1>
                    <p class="text-white-50 mt-2">Total Barang: <span id="total_barang_display">Rp 0</span></p>
                </div>
            </div>
        </div>
    </div>

    
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="m-0"><i class="fas fa-shopping-cart me-2"></i> Keranjang Belanja</h5>
            <button type="button" class="btn btn-primary btn-sm" id="add_row_btn">
                <i class="fas fa-plus"></i> Tambah Baris
            </button>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-striped m-0 align-middle" id="cart_table">
                    <thead class="table-light">
                        <tr>
                            <th width="40%">Nama Barang</th>
                            <th width="15%">Harga Satuan</th>
                            <th width="10%">Qty</th>
                            <th width="20%" class="text-end">Subtotal</th>
                            <th width="5%" class="text-center">Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="item-row">
                            <td>
                                <select name="items[0][id_barang]" class="form-select barang-select" required>
                                    <option value="" data-price="0">-- Pilih Barang --</option>
                                    <?php $__currentLoopData = $barangs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($b->id_barang); ?>" data-price="<?php echo e($b->harga_jual); ?>">
                                            <?php echo e($b->nama_barang); ?> (Stok: <?php echo e($b->stok_barang); ?>)
                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </td>
                            <td class="price-display">Rp 0</td>
                            <td>
                                <input type="number" name="items[0][jumlah_barang]" class="form-control qty-input" min="1" value="1" required>
                            </td>
                            <td class="subtotal-display text-end fw-bold">Rp 0</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="3" class="text-end fw-bold">Biaya Tambahan / Ongkir (Rp):</td>
                            <td>
                                <input type="number" name="total_biaya_pengiriman" id="shipping_cost" value="0" min="0" class="form-control text-end">
                            </td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white p-3">
            <button type="submit" class="btn btn-success btn-lg w-100">
                <i class="fas fa-save me-2"></i> SIMPAN TRANSAKSI
            </button>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        let rowIndex = 1;

        function formatRupiah(angka) {
            return 'Rp ' + parseFloat(angka).toLocaleString('id-ID');
        }

        function calculateTotal() {
            let totalBarang = 0;
            $('.item-row').each(function() {
                let price = $(this).find('.barang-select option:selected').data('price') || 0;
                let qty = $(this).find('.qty-input').val() || 0;
                let subtotal = price * qty;
                $(this).find('.price-display').text(formatRupiah(price));
                $(this).find('.subtotal-display').text(formatRupiah(subtotal));
                totalBarang += subtotal;
            });

            let ongkir = parseFloat($('#shipping_cost').val()) || 0;
            let grandTotal = totalBarang + ongkir;

            $('#total_barang_display').text(formatRupiah(totalBarang));
            $('#grand_total_display').text(formatRupiah(grandTotal));
        }

        $(document).on('change keyup', '.barang-select, .qty-input, #shipping_cost', function() {
            calculateTotal();
        });

        $('#add_row_btn').click(function() {
            let html = `
                <tr class="item-row">
                    <td>
                        <select name="items[${rowIndex}][id_barang]" class="form-select barang-select" required>
                            <option value="" data-price="0">-- Pilih Barang --</option>
                            <?php $__currentLoopData = $barangs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($b->id_barang); ?>" data-price="<?php echo e($b->harga_jual); ?>">
                                    <?php echo e($b->nama_barang); ?> (Stok: <?php echo e($b->stok_barang); ?>)
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </td>
                    <td class="price-display">Rp 0</td>
                    <td><input type="number" name="items[${rowIndex}][jumlah_barang]" class="form-control qty-input" min="1" value="1" required></td>
                    <td class="subtotal-display text-end fw-bold">Rp 0</td>
                    <td class="text-center"><button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-trash"></i></button></td>
                </tr>
            `;
            $('#cart_table tbody').append(html);
            rowIndex++;
        });

        $(document).on('click', '.remove-row', function() {
            if($('.item-row').length > 1) {
                $(this).closest('tr').remove();
                calculateTotal();
            } else {
                alert("Minimal harus ada satu barang!");
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\transaksi\resources\views/pemesanan/create.blade.php ENDPATH**/ ?>