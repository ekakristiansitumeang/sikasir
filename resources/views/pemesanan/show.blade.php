@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')

{{-- CSS KHUSUS CETAK (Hanya aktif saat window.print() dijalankan) --}}
<style>
    @media print {
        /* Sembunyikan Sidebar, Tombol, dan Elemen tidak penting */
        .sidebar, .top-navbar, .btn, .no-print, footer {
            display: none !important;
        }
        /* Reset margin konten agar memenuhi kertas */
        .content {
            margin: 0 !important;
            padding: 0 !important;
            background: white !important;
        }
        /* Hilangkan bayangan card agar hemat tinta */
        .card {
            border: none !important;
            box-shadow: none !important;
        }
        /* Pastikan teks hitam pekat */
        body {
            color: black !important;
            background: white !important;
        }
    }
</style>

<div class="container-fluid p-0">
    
    {{-- Tombol Aksi (Akan hilang saat diprint) --}}
    <div class="d-flex justify-content-between mb-4 no-print">
        <a href="{{ route('pemesanan.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
        <button onclick="window.print()" class="btn btn-primary">
            <i class="fas fa-print me-2"></i> Cetak Nota / Invoice
        </button>
    </div>

    {{-- KARTU INVOICE --}}
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-body p-5">
            
            {{-- HEADER INVOICE --}}
            <div class="row border-bottom pb-4 mb-4">
                <div class="col-md-6">
                    <h2 class="fw-bold text-primary"><i class="fas fa-cash-register me-2"></i> SiKasir Store</h2>
                    <p class="text-muted mb-0">Jl. Teknologi No. 123, Surabaya</p>
                    <p class="text-muted">Telp: 0812-3456-7890</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <h4 class="fw-bold">INVOICE</h4>
                    <p class="mb-1"><strong>No:</strong> {{ $pemesanan->id_pemesanan }}</p>
                    <p class="mb-1"><strong>Tanggal:</strong> {{ date('d F Y', strtotime($pemesanan->tgl_pemesanan)) }}</p>
                    <p>
                        <strong>Status:</strong> 
                        @if($pemesanan->status_pemesanan == 'Lunas')
                            <span class="badge bg-success text-uppercase">LUNAS</span>
                        @else
                            <span class="badge bg-warning text-dark text-uppercase">BELUM LUNAS</span>
                        @endif
                    </p>
                </div>
            </div>

            {{-- INFO PELANGGAN & KASIR --}}
            <div class="row mb-4">
                <div class="col-6">
                    <h6 class="text-uppercase text-muted fw-bold small">Kepada Yth:</h6>
                    <h5 class="fw-bold">{{ $pemesanan->konsumen->nama_calon_konsumen ?? 'Pelanggan Umum' }}</h5>
                    <p class="text-muted mb-0">{{ $pemesanan->konsumen->email_calon_konsumen ?? '-' }}</p>
                    <p class="text-muted">ID Negara: {{ $pemesanan->konsumen->id_negara ?? '-' }}</p>
                </div>
                <div class="col-6 text-md-end">
                    <h6 class="text-uppercase text-muted fw-bold small">Kasir Bertugas:</h6>
                    <p class="fw-bold mb-0">{{ Auth::user()->nama_pegawai ?? $pemesanan->id_pegawai }}</p>
                </div>
            </div>

            {{-- TABEL BARANG --}}
            <div class="table-responsive mb-4">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Harga Satuan</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pemesanan->details as $index => $detail)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>
                                <strong>{{ $detail->barang->nama_barang ?? 'Barang Terhapus' }}</strong>
                                <br><small class="text-muted">{{ $detail->id_barang }}</small>
                            </td>
                            <td class="text-end">Rp {{ number_format(($detail->sub_total / $detail->jumlah_barang), 0, ',', '.') }}</td>
                            <td class="text-center">{{ $detail->jumlah_barang }}</td>
                            <td class="text-end fw-bold">Rp {{ number_format($detail->sub_total, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- TOTAL HARGA --}}
            <div class="row">
                <div class="col-md-6">
                    <p class="text-muted fst-italic">
                        Terima kasih telah berbelanja di SiKasir Store.<br>
                        Barang yang sudah dibeli tidak dapat ditukar/dikembalikan.
                    </p>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <td class="text-end"><strong>Total Harga Barang:</strong></td>
                            <td class="text-end w-25">Rp {{ number_format($pemesanan->total_harga - $pemesanan->total_biaya_pengiriman, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="text-end"><strong>Ongkos Kirim:</strong></td>
                            <td class="text-end">Rp {{ number_format($pemesanan->total_biaya_pengiriman, 0, ',', '.') }}</td>
                        </tr>
                        <tr class="border-top border-2 border-dark">
                            <td class="text-end"><h4 class="fw-bold">TOTAL BIAYA:</h4></td>
                            <td class="text-end"><h4 class="fw-bold text-primary">Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</h4></td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection