@extends('layouts.app')

@section('title', 'Laporan Transaksi (SQL View)')

@section('content')

{{-- CSS KHUSUS PRINT --}}
<style>
    @media print {
        /* 1. Sembunyikan Sidebar, Navbar, dan Tombol */
        .sidebar, .top-navbar, .btn, .alert {
            display: none !important;
        }

        /* 2. Reset Margin agar konten memenuhi kertas */
        .content {
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        /* 3. Hilangkan border/shadow card agar hemat tinta */
        .card {
            border: none !important;
            box-shadow: none !important;
        }

        /* 4. Paksa Orientasi Landscape (Mendatar) agar tabel tidak terpotong */
        @page {
            size: landscape;
            margin: 10mm;
        }

        /* 5. Pastikan tabel tercetak utuh */
        table {
            width: 100% !important;
            border-collapse: collapse !important;
        }
        
        /* 6. Header tabel warna gelap tetap tercetak */
        .table-dark {
            background-color: #333 !important;
            color: white !important;
            -webkit-print-color-adjust: exact;
        }
    }
</style>

<div class="card shadow-sm border-0">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="m-0"><i class="fas fa-file-alt me-2"></i> Data Laporan Transaksi</h5>
        
        {{-- Tombol Cetak --}}
        <button onclick="window.print()" class="btn btn-light btn-sm text-primary fw-bold">
            <i class="fas fa-print me-1"></i> Cetak Laporan
        </button>
    </div>
    
    <div class="card-body">
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>
            Halaman ini menampilkan data langsung dari SQL View: <strong>v_laporan_transaksi</strong>.
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Tanggal</th>
                        <th>Nama Pelanggan</th>
                        <th>Kasir (Pegawai)</th>
                        <th>Status</th>
                        <th>Total Omset</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporan as $row)
                    <tr>
                        <td class="text-center">{{ $row->id_pemesanan }}</td>
                        <td class="text-center">{{ $row->tgl_pemesanan }}</td>
                        {{-- Pastikan nama kolom sesuai VIEW SQL Anda --}}
                        <td>{{ $row->nama_calon_konsumen ?? $row->pelanggan }}</td> 
                        <td>{{ $row->nama_pegawai ?? $row->kasir }}</td>
                        <td class="text-center">
                            @if($row->status_pemesanan == 'Lunas')
                                <span class="badge bg-success">LUNAS</span>
                            @else
                                <span class="badge bg-warning text-dark">BELUM</span>
                            @endif
                        </td>
                        <td class="text-end fw-bold">Rp {{ number_format($row->total_harga, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Data laporan kosong.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Footer Laporan (Hanya muncul saat print jika mau) --}}
        <div class="d-none d-print-block mt-4 text-end">
            <p>Dicetak pada: {{ date('d F Y H:i') }}</p>
            <br><br>
            <p>( Tanda Tangan Admin )</p>
        </div>
    </div>
</div>
@endsection