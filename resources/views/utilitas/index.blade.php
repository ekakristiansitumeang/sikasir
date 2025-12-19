@extends('layouts.app')
@section('title', 'Cek Utilitas (SP & Function)')
@section('content')
<div class="row">
    
    {{-- CARD 1: CEK STOK (Menggunakan FUNCTION) --}}
    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-info text-white">
                <i class="fas fa-search me-2"></i> Cek Status Stok (SQL Function)
            </div>
            <div class="card-body">
                <p class="text-muted">Fitur ini menggunakan Stored Function <code>f_cek_stok</code> untuk mengecek status barang.</p>
                
                <form action="{{ route('utilitas.stok') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Pilih Barang</label>
                        <select name="id_barang" class="form-select">
                            @foreach($barangs as $b)
                                <option value="{{ $b->id_barang }}">{{ $b->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-info text-white w-100">Cek Status</button>
                </form>

                @if(session('hasil_stok'))
                    <div class="alert alert-warning mt-3 text-center fw-bold">
                        {{ session('hasil_stok') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- CARD 2: CEK OMSET (Menggunakan STORED PROCEDURE) --}}
    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-success text-white">
                <i class="fas fa-money-bill-wave me-2"></i> Cek Omset (SQL SP)
            </div>
            <div class="card-body">
                <p class="text-muted">Fitur ini menggunakan Stored Procedure <code>sp_cek_omset</code> untuk menghitung pendapatan.</p>
                
                <form action="{{ route('utilitas.omset') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-6">
                            <label>Dari Tanggal</label>
                            <input type="date" name="tgl_mulai" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label>Sampai Tanggal</label>
                            <input type="date" name="tgl_selesai" class="form-control" required>
                        </div>
                    </div>
                    <button class="btn btn-success w-100">Hitung Omset</button>
                </form>

                @if(session('hasil_omset'))
                    <div class="alert alert-success mt-3 text-center fw-bold fs-5">
                        {{ session('hasil_omset') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
@endsection