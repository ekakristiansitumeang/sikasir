@extends('layouts.app')
@section('title', 'Input Pembelian (Restock)')
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="m-0"><i class="fas fa-cart-arrow-down me-2"></i> Form Pengadaan Barang</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('pembelian.store') }}" method="POST">
            @csrf
            
            {{-- Bagian Atas: Info Nota & Supplier --}}
            <div class="row mb-4">
                <div class="col-md-4">
                    <label>ID Pembelian</label>
                    <input type="text" name="id_pembelian" class="form-control bg-light" value="{{ $newId }}" readonly>
                </div>
                <div class="col-md-4">
                    <label>Tanggal</label>
                    <input type="text" class="form-control bg-light" value="{{ date('d-m-Y H:i') }}" readonly>
                </div>
                <div class="col-md-4">
                    <label>Pilih Supplier</label>
                    <select name="id_supplier" class="form-select" required>
                        <option value="">-- Pilih Supplier --</option>
                        @foreach($suppliers as $s)
                            <option value="{{ $s->id_supplier }}">{{ $s->nama_supplier }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <hr>

            {{-- Bagian Tengah: Tabel Input Barang Dynamic --}}
            <h6 class="text-muted mb-3">Daftar Barang yang Dibeli</h6>
            <table class="table table-bordered" id="tabelBarang">
                <thead class="table-light">
                    <tr>
                        <th width="40%">Nama Barang</th>
                        <th width="20%">Harga Beli (Satuan)</th>
                        <th width="15%">Jumlah (Qty)</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="barang_id[]" class="form-select" required>
                                <option value="">-- Pilih Barang --</option>
                                @foreach($barangs as $b)
                                    <option value="{{ $b->id_barang }}">{{ $b->nama_barang }} (Stok: {{ $b->stok_barang }})</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" name="harga[]" class="form-control" placeholder="Rp" required>
                        </td>
                        <td>
                            <input type="number" name="jumlah[]" class="form-control" placeholder="Qty" required>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-row" disabled><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <button type="button" class="btn btn-info text-white btn-sm mb-4" id="addRow">
                <i class="fas fa-plus"></i> Tambah Baris Barang
            </button>

            <div class="d-grid">
                <button class="btn btn-success btn-lg"><i class="fas fa-save me-2"></i> SIMPAN & TAMBAH STOK</button>
            </div>
        </form>
    </div>
</div>

{{-- SCRIPT SEDERHANA UNTUK NAMBAH BARIS --}}
<script>
    document.getElementById('addRow').addEventListener('click', function() {
        var table = document.getElementById('tabelBarang').getElementsByTagName('tbody')[0];
        var newRow = table.rows[0].cloneNode(true);
        
        // Reset nilai input di baris baru
        var inputs = newRow.getElementsByTagName('input');
        for (var i = 0; i < inputs.length; i++) { inputs[i].value = ''; }
        
        // Aktifkan tombol hapus
        newRow.querySelector('.remove-row').disabled = false;
        
        table.appendChild(newRow);
    });

    // Event Delegation untuk tombol hapus
    document.getElementById('tabelBarang').addEventListener('click', function(e) {
        if (e.target.closest('.remove-row')) {
            if (document.querySelectorAll('#tabelBarang tbody tr').length > 1) {
                e.target.closest('tr').remove();
            }
        }
    });
</script>
@endsection