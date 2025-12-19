@extends('layouts.app')
@section('title', 'Surat Jalan')
@section('content')

<style>
    @media print {
        .sidebar, .btn, .no-print { display: none !important; }
        .content { margin: 0 !important; width: 100% !important; }
        .card { border: none !important; }
    }
</style>
        <div class="card shadow-sm bg-light">
            <div class="card-body">
                <h5 class="fw-bold"><i class="fas fa-camera me-2"></i> Upload Dokumentasi</h5>
                <form action="{{ route('pengiriman.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_pengiriman" value="{{ $pengiriman->id_pengiriman }}">
                    
                    {{-- Input Jenis Dokumen (Kolom id_jenis_dokumen) --}}
                    <div class="mb-3">
                        <label>Jenis Dokumen</label>
                        <select name="jenis_dokumen" class="form-select" required>
                            <option value="FOTO_PAKET">Foto Paket</option>
                            <option value="RESI_FISIK">Resi Fisik</option>
                            <option value="SERAH_TERIMA">Berita Acara / Tanda Terima</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Pilih File Foto</label>
                        <input type="file" name="foto_bukti" class="form-control" required>
                    </div>

                    <button class="btn btn-success w-100"><i class="fas fa-upload"></i> Unggah Bukti</button>
                </form>
            </div>
        </div>


        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Qty</th>
                    <th>Ceklist</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengiriman->pemesanan->details as $index => $detail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $detail->barang->nama_barang }}</td>
                    <td>{{ $detail->jumlah_barang }}</td>
                    <td>[   ]</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row mt-5 text-center">
            <div class="col-4">Penerima,<br><br><br>( ..................... )</div>
            <div class="col-4"></div>
            <div class="col-4">Petugas Gudang,<br><br><br>( {{ Auth::user()->nama_pegawai }} )</div>
        </div>
    </div>
</div>
        
        <hr class="my-5 border-2 border-dark no-print">

        {{-- AREA DOKUMENTASI (Hanya muncul di Layar, tidak diprint) --}}
        <div class="row no-print">
            <div class="col-md-5">
                <div class="card shadow-sm bg-light">
                    <div class="card-body">
                        <h5 class="fw-bold"><i class="fas fa-camera me-2"></i> Upload Bukti / Resi</h5>
                        <form action="{{ route('pengiriman.upload') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_pengiriman" value="{{ $pengiriman->id_pengiriman }}">
                            
                            <div class="mb-3">
                                <label>Pilih Foto</label>
                                <input type="file" name="foto_bukti" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Keterangan (Opsional)</label>
                                <input type="text" name="keterangan" class="form-control" placeholder="Contoh: Paket diterima satpam">
                            </div>
                            <button class="btn btn-success w-100"><i class="fas fa-upload"></i> Unggah Foto</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <h5 class="fw-bold mb-3"><i class="fas fa-images me-2"></i> Galeri Dokumentasi</h5>
                <div class="row g-3">
                    @forelse($pengiriman->dokumentasi as $dok)
                        <div class="col-md-4">
                            <div class="card h-100">
                                {{-- Menampilkan Gambar dari Storage --}}
                                <img src="{{ asset('bukti_pengiriman/' . $dok->file_path) }}" class="card-img-top" alt="Bukti" style="height: 150px; object-fit: cover;">
                                <div class="card-footer p-2 text-center small text-muted">
                                    {{ $dok->keterangan }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center text-muted py-5 border rounded bg-white">
                            Belum ada bukti foto diunggah.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div> {{-- Penutup Card Body Utama --}}
</div> {{-- Penutup Card Utama --}}
@endsection