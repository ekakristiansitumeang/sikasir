@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title m-0 text-muted">Kelola Stok & Harga</h5>
                <a href="{{ route('barang.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Barang
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID Barang</th>
                            <th>Nama Barang</th>
                            <th>Jenis</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th class="text-center">Stok</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barangs as $b)
                        <tr>
                            <td>{{ $b->id_barang }}</td>
                            <td class="fw-bold">{{ $b->nama_barang }}</td>
                            <td>{{ $b->id_jenis_barang }}</td>
                            <td>Rp {{ number_format($b->harga_beli, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($b->harga_jual, 0, ',', '.') }}</td>
                            <td class="text-center">
                                {{-- Badge Stok: Merah jika < 5, Hijau jika aman --}}
                                <span class="badge {{ $b->stok_barang < 5 ? 'bg-danger' : 'bg-success' }} rounded-pill px-3">
                                    {{ $b->stok_barang }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('barang.edit', $b->id_barang) }}" class="btn btn-sm btn-warning text-white" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <form action="{{ route('barang.destroy', $b->id_barang) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus barang ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="fas fa-box-open fa-2x mb-2"></i><br>
                                Belum ada data barang.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection