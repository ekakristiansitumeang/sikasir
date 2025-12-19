@extends('layouts.app')
@section('title', 'Data Jenis Barang')
@section('content')
<div class="row">
    {{-- Form Tambah (Kiri) --}}
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">Tambah Jenis</div>
            <div class="card-body">
                <form action="{{ route('jenis.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>ID Jenis</label>
                        <input type="text" name="id_jenis" class="form-control" placeholder="JNS01" required>
                    </div>
                    <div class="mb-3">
                        <label>Nama Jenis</label>
                        <input type="text" name="nama_jenis" class="form-control" placeholder="Elektronik" required>
                    </div>
                    <button class="btn btn-success w-100">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Tabel Data (Kanan) --}}
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white">Daftar Jenis Barang</div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama Jenis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jenis as $j)
                        <tr>
                            <td>{{ $j->id_jenis }}</td>
                            <td>{{ $j->nama_jenis }}</td>
                            <td>
                                <form action="{{ route('jenis.destroy', $j->id_jenis) }}" method="POST" onsubmit="return confirm('Hapus?')">
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