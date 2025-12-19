@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title m-0 text-muted">Daftar Transaksi Masuk</h5>
                <a href="{{ route('pemesanan.create') }}" class="btn btn-primary">
                    <i class="fas fa-cart-plus"></i> Transaksi Baru
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Tanggal</th>
                            <th>Pelanggan</th>
                            <th>Total Belanja</th>
                            <th>Status</th>
                            <th>Pegawai</th>
                            <th class="text-center" width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pemesanans as $p)
                        <tr>
                            <td><span class="badge bg-secondary">{{ $p->id_pemesanan }}</span></td>
                            <td>{{ $p->tgl_pemesanan }}</td>
                            <td>{{ $p->konsumen->nama_calon_konsumen ?? 'Umum' }}</td>
                            <td class="fw-bold">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
                            <td>
                                @if($p->status_pemesanan == 'Lunas')
                                    <span class="badge bg-success">LUNAS</span>
                                @else
                                    <span class="badge bg-warning text-dark">BELUM BAYAR</span>
                                @endif
                            </td>
                            <td>{{ $p->id_pegawai }}</td> 
                            
                            {{-- KOLOM AKSI --}}
                            <td class="text-center">
                                {{-- 1. Tombol Detail (Selalu Muncul) --}}
                                <a href="{{ route('pemesanan.show', $p->id_pemesanan) }}" class="btn btn-sm btn-info text-white me-1" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>

                                {{-- LOGIKA TOMBOL LAINNYA --}}
                                @if($p->status_pemesanan == 'Baru')
                                    {{-- KONDISI 1: Belum Lunas --}}
                                    <a href="{{ route('pembayaran.create', $p->id_pemesanan) }}" class="btn btn-sm btn-success me-1" title="Bayar">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </a>

                                    <form action="{{ route('pemesanan.destroy', $p->id_pemesanan) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin batalkan transaksi ini? Stok akan dikembalikan.')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" title="Batalkan">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>

                                @elseif($p->status_pemesanan == 'Lunas')
                                    {{-- KONDISI 2: Sudah Lunas --}}
                                    
                                    @if($p->pengiriman)
                                        {{-- 2A: Sudah Dikirim -> Lihat Resi --}}
                                        <a href="{{ route('pengiriman.show', $p->pengiriman->id_pengiriman) }}" class="btn btn-sm btn-secondary" title="Lihat Surat Jalan">
                                            <i class="fas fa-truck"></i> Resi
                                        </a>
                                    @else
                                        {{-- 2B: Belum Dikirim -> Tombol Kirim --}}
                                        <form action="{{ route('pengiriman.store') }}" method="POST" class="d-inline" onsubmit="return confirm('Proses pengiriman barang sekarang?')">
                                            @csrf
                                            <input type="hidden" name="id_pemesanan" value="{{ $p->id_pemesanan }}">
                                            <button class="btn btn-sm btn-warning" title="Kirim Barang">
                                                <i class="fas fa-shipping-fast"></i> Kirim
                                            </button>
                                        </form>
                                    @endif

                                @endif {{-- Penutup IF Status Pemesanan (Ini yang sering lupa!) --}}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="fas fa-receipt fa-2x mb-2"></i><br>
                                Belum ada riwayat transaksi.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection