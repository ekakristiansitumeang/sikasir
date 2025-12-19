@extends('layouts.app')
@section('title', 'Data Jabatan')
@section('content')
<div class="row">
    {{-- Form Tambah (Kiri) --}}
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">Tambah Jabatan</div>
            <div class="card-body">
                <form action="{{ route('jabatan.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>ID Jabatan</label>
                        <input type="text" name="id_jabatan" class="form-control" placeholder="JAB01" required>
                    </div>
                    <div class="mb-3">
                        <label>Nama Jabatan</label>
                        <input type="text" name="nama_jabatan" class="form-control" placeholder="Kasir / Admin" required>
                    </div>
                    <button class="btn btn-success w-100">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Tabel Data (Kanan) --}}
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white">Daftar Jabatan</div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Jabatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jabatans as $j)
                        <tr>
                            <td>{{ $j->id_jabatan }}</td>
                            <td>{{ $j->nama_jabatan }}</td>
                            <td>
                                <form action="{{ route('jabatan.destroy', $j->id_jabatan) }}" method="POST" onsubmit="return confirm('Hapus?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection