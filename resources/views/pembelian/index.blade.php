@extends('layouts.app')
@section('title', 'Riwayat Pembelian')
@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="m-0">Riwayat Pengadaan (Barang Masuk)</h5>
        <a href="{{ route('pembelian.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Stok Masuk Baru
        </a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID Nota</th>
                    <th>Tanggal</th>
                    <th>Supplier</th>
                    <th>Petugas</th>
                    <th>Total Biaya</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pembelians as $p)
                <tr>
                    <td>{{ $p->id_pembelian }}</td>
                    <td>{{ $p->tgl_pembelian }}</td>
                    <td>{{ $p->supplier->nama_supplier ?? 'Umum' }}</td>
                    <td>{{ $p->pegawai->nama_pegawai ?? '-' }}</td>
                    <td class="fw-bold">Rp {{ number_format($p->total_biaya, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('pembelian.show', $p->id_pembelian) }}" class="btn btn-info btn-sm text-white">Detail</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center">Belum ada data pembelian.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection