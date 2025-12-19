@extends('layouts.app')
@section('title', 'Detail Pembelian')
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-light">
        <strong>Detail Nota: {{ $pembelian->id_pembelian }}</strong>
        <span class="float-end">{{ $pembelian->tgl_pembelian }}</span>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-6">
                <h6 class="fw-bold">Dari Supplier:</h6>
                <p>{{ $pembelian->supplier->nama_supplier }}<br>
                   {{ $pembelian->supplier->alamat }}</p>
            </div>
            <div class="col-6 text-end">
                <h6 class="fw-bold">Penerima (Admin):</h6>
                <p>{{ $pembelian->pegawai->nama_pegawai }}</p>
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
                @foreach($pembelian->details as $detail)
                <tr>
                    <td>{{ $detail->barang->nama_barang }}</td>
                    <td>Rp {{ number_format($detail->harga_beli_satuan) }}</td>
                    <td>{{ $detail->jumlah_beli }}</td>
                    <td class="text-end">Rp {{ number_format($detail->harga_beli_satuan * $detail->jumlah_beli) }}</td>
                </tr>
                @endforeach
                <tr class="fw-bold fs-5">
                    <td colspan="3" class="text-end">TOTAL</td>
                    <td class="text-end">Rp {{ number_format($pembelian->total_biaya) }}</td>
                </tr>
            </tbody>
        </table>

        <a href="{{ route('pembelian.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>
@endsection