@extends('layouts.app')

@section('title', 'Tambah Pelanggan Baru')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="m-0"><i class="fas fa-user-plus me-2"></i> Form Registrasi Pelanggan</h5>
                </div>
                <div class="card-body p-4">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('konsumen.store') }}" method="POST">
                        @csrf
                        
                        {{-- Jika ID Konsumen Auto Increment, field ini dihapus saja. 
                             Tapi jika Anda input manual angka '3' tadi, biarkan field ini. --}}
                        <div class="mb-3">
                            <label class="form-label">ID Konsumen</label>
                            <input type="number" name="id_calon_konsumen" class="form-control" value="{{ old('id_calon_konsumen') }}" placeholder="Auto / Isi Manual" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama_calon_konsumen" class="form-control" value="{{ old('nama_calon_konsumen') }}" placeholder="Nama Konsumen" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email_calon_konsumen" class="form-control" value="{{ old('email_calon_konsumen') }}" placeholder="email@contoh.com" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">ID Negara</label>
                                <input type="number" name="id_negara" class="form-control" value="{{ old('id_negara') }}" placeholder="Contoh: 12" required>
                                <div class="form-text">Pastikan ID Negara sudah terdaftar di database.</div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Tanggal Pendaftaran</label>
                            <input type="date" name="tgl_pendaftaran" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('konsumen.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-success"><i class="fas fa-save me-1"></i> Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection