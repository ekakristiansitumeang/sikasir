@extends('layouts.app')

@section('title', 'Kasir / Transaksi Baru')

@section('content')
<form action="{{ route('pemesanan.store') }}" method="POST">
    @csrf

    <div class="row">
        {{-- KOLOM KIRI: DATA PELANGGAN --}}
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
                            @foreach($konsumens as $k)
                                <option value="{{ $k->id_calon_konsumen }}">
                                    {{ $k->nama_calon_konsumen }} (ID: {{ $k->id_calon_konsumen }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal Transaksi</label>
                        <input type="date" name="tgl_pemesanan" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: RINGKASAN PEMBAYARAN --}}
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

    {{-- BAGIAN BAWAH: KERANJANG BELANJA --}}
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
                                    @foreach($barangs as $b)
                                        <option value="{{ $b->id_barang }}" data-price="{{ $b->harga_jual }}">
                                            {{ $b->nama_barang }} (Stok: {{ $b->stok_barang }})
                                        </option>
                                    @endforeach
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
@endsection

@section('scripts')
{{-- JQUERY SCRIPT (LOGIKA HITUNGAN) --}}
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
                            @foreach($barangs as $b)
                                <option value="{{ $b->id_barang }}" data-price="{{ $b->harga_jual }}">
                                    {{ $b->nama_barang }} (Stok: {{ $b->stok_barang }})
                                </option>
                            @endforeach
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
@endsection