@extends('layouts.app')

@section('title', 'Data Pelanggan')

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title m-0 text-muted">Daftar Calon Konsumen</h5>
                <a href="{{ route('konsumen.create') }}" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> Tambah Pelanggan
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Negara (ID)</th>
                            <th>Tgl Daftar</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($konsumens as $k)
                        <tr>
                            <td>{{ $k->id_calon_konsumen }}</td>
                            <td class="fw-bold">{{ $k->nama_calon_konsumen }}</td>
                            <td>
                                <a href="mailto:{{ $k->email_calon_konsumen }}" class="text-decoration-none">
                                    {{ $k->email_calon_konsumen }}
                                </a>
                            </td>
                            <td>{{ $k->id_negara }}</td>
                            <td>{{ $k->tgl_pendaftaran }}</td>
                            <td class="text-center">
                                <a href="{{ route('konsumen.edit', $k->id_calon_konsumen) }}" class="btn btn-sm btn-warning text-white" title="Edit">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                                
                                <form action="{{ route('konsumen.destroy', $k->id_calon_konsumen) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data pelanggan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="fas fa-users-slash fa-2x mb-2"></i><br>
                                Belum ada data pelanggan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection