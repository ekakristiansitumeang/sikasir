@extends('layouts.app')
@section('title', 'Data Supplier')
@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="m-0">Daftar Supplier (Pemasok)</h5>
        <a href="{{ route('supplier.create') }}" class="btn btn-primary btn-sm">Tambah Supplier</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Supplier</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($suppliers as $s)
                <tr>
                    <td>{{ $s->id_supplier }}</td>
                    <td>{{ $s->nama_supplier }}</td>
                    <td>{{ $s->no_telp }}</td>
                    <td>{{ $s->alamat }}</td>
                    <td>
                        <form action="{{ route('supplier.destroy', $s->id_supplier) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection