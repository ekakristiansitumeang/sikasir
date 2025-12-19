@extends('layouts.app')
@section('title', 'Tambah Supplier')
@section('content')
<div class="card col-md-6 mx-auto shadow-sm">
    <div class="card-body">
        <h4>Tambah Supplier Baru</h4>
        <hr>
        <form action="{{ route('supplier.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>ID Supplier</label>
                <input type="text" name="id_supplier" class="form-control" placeholder="SUP001" required>
            </div>
            <div class="mb-3">
                <label>Nama PT / Toko</label>
                <input type="text" name="nama_supplier" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>No Telepon</label>
                <input type="text" name="no_telp" class="form-control">
            </div>
            <div class="mb-3">
                <label>Alamat Lengkap</label>
                <textarea name="alamat" class="form-control"></textarea>
            </div>
            <button class="btn btn-success w-100">Simpan Data</button>
        </form>
    </div>
</div>
@endsection