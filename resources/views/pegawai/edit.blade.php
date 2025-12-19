@extends('layouts.app')
@section('title', 'Edit Pegawai')
@section('content')
<div class="card col-md-8 mx-auto shadow-sm">
    <div class="card-header bg-warning text-dark">Edit Data Pegawai</div>
    <div class="card-body">
        <form action="{{ route('pegawai.update', $pegawai->id_pegawai) }}" method="POST">
            @csrf @method('PUT')
            
            <div class="mb-3">
                <label>ID Pegawai</label>
                <input type="text" class="form-control" value="{{ $pegawai->id_pegawai }}" readonly disabled>
            </div>
            
            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_pegawai" class="form-control" value="{{ $pegawai->nama_pegawai }}" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Jabatan</label>
                    <select name="id_jabatan" class="form-select">
                        @foreach($jabatans as $j)
                            <option value="{{ $j->id_jabatan }}" {{ $pegawai->id_jabatan == $j->id_jabatan ? 'selected' : '' }}>
                                {{ $j->nama_jabatan }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Status</label>
                    <select name="status_user" class="form-select">
                        <option value="Aktif" {{ $pegawai->status_user == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Nonaktif" {{ $pegawai->status_user == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label>Password (Kosongkan jika tidak ingin mengubah)</label>
                <input type="password" name="password" class="form-control" placeholder="Isi password baru jika ingin diganti...">
            </div>

            <button class="btn btn-primary w-100">Update Data</button>
        </form>
    </div>
</div>
@endsection