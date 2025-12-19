@extends('layouts.app')
@section('title', 'Data Pegawai')
@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="m-0">Data Pegawai</h5>
        <a href="{{ route('pegawai.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Pegawai</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pegawais as $p)
                <tr>
                    <td>{{ $p->id_pegawai }}</td>
                    <td>{{ $p->nama_pegawai }}</td>
                    <td>{{ $p->jabatan->nama_jabatan ?? '-' }}</td>
                    <td>
                        <span class="badge {{ $p->status_user == 'Aktif' ? 'bg-success' : 'bg-danger' }}">
                            {{ $p->status_user }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('pegawai.edit', $p->id_pegawai) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('pegawai.destroy', $p->id_pegawai) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus user ini?')">
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
@endsection