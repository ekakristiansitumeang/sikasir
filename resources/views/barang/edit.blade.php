@extends('layouts.app')

@section('title', 'Edit Data Barang')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h5 class="card-title mb-4">Edit Barang: <strong>{{ $barang->nama_barang }}</strong></h5>

                    <form action="{{ route('barang.update', $barang->id_barang) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        {{-- ID Readonly karena PK --}}
                        <div class="mb-3">
                            <label class="form-label">ID Barang</label>
                            <input type="text" name="id_barang" class="form-control bg-light" value="{{ $barang->id_barang }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Barang</label>
                            <input type="text" name="id_jenis_barang" class="form-control" value="{{ old('id_jenis_barang', $barang->id_jenis_barang) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang', $barang->nama_barang) }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Harga Beli</label>
                                <input type="number" name="harga_beli" class="form-control" value="{{ old('harga_beli', $barang->harga_beli) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Harga Jual</label>
                                <input type="number" name="harga_jual" class="form-control" value="{{ old('harga_jual', $barang->harga_jual) }}" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Stok</label>
                            <input type="number" name="stok_barang" class="form-control" value="{{ old('stok_barang', $barang->stok_barang) }}" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('barang.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-sync-alt me-1"></i> Update Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection