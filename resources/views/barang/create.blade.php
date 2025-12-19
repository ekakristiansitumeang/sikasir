@extends('layouts.app')

@section('title', 'Tambah Barang Baru')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="m-0"><i class="fas fa-box me-2"></i> Form Input Barang</h5>
                </div>
                <div class="card-body p-4">
                    
                    {{-- Tampilkan Error Validasi --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('barang.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">ID Barang</label>
                            <input type="text" name="id_barang" class="form-control" value="{{ old('id_barang') }}" placeholder="Contoh: BRG001" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Barang (ID)</label>
                            <input type="text" name="id_jenis_barang" class="form-control" value="{{ old('id_jenis_barang') }}" placeholder="Contoh: ATK / ELEKTRONIK" required>
                            <div class="form-text">Pastikan kode jenis barang sesuai referensi.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang') }}" placeholder="Contoh: Buku Tulis Sidu" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Harga Beli</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="harga_beli" class="form-control" value="{{ old('harga_beli') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Harga Jual</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="harga_jual" class="form-control" value="{{ old('harga_jual') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Stok Awal</label>
                            <input type="number" name="stok_barang" class="form-control" value="{{ old('stok_barang') }}" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('barang.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-success"><i class="fas fa-save me-1"></i> Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection