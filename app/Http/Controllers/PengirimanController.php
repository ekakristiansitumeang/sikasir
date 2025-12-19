<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use App\Models\Pemesanan;
use App\Models\DetailPengirimanDok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PengirimanController extends Controller
{
    public function index()
    {
        $pengirimans = Pengiriman::with(['pemesanan.konsumen', 'pegawai'])
                        ->orderBy('tgl_pengiriman', 'desc')
                        ->get();
                        
        return view('pengiriman.index', compact('pengirimans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pemesanan' => 'required|exists:pemesanan,id_pemesanan'
        ]);

        $cek = Pengiriman::where('id_pemesanan', $request->id_pemesanan)->first();
        if($cek) {
            return back()->with('error', 'Barang untuk transaksi ini sudah dikirim sebelumnya!');
        }

        Pengiriman::create([
            'id_pengiriman' => 'KRM-' . time(), 
            'id_pemesanan' => $request->id_pemesanan,
            'id_pegawai' => Auth::user()->id_pegawai, 
            'tgl_pengiriman' => date('Y-m-d'), 
        ]);

        return redirect()->route('pemesanan.index')->with('success', 'Status pengiriman berhasil dibuat!');
    }
    
    public function show($id)
    {
        $pengiriman = Pengiriman::with(['pemesanan.details.barang', 'pemesanan.konsumen', 'dokumentasi'])->findOrFail($id);
        return view('pengiriman.show', compact('pengiriman'));
    }

    public function uploadBukti(Request $request)
    {
        $request->validate([
            'id_pengiriman' => 'required',
            'foto_bukti' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'jenis_dokumen' => 'required|string',
        ]);

        if ($request->hasFile('foto_bukti')) {
            $file = $request->file('foto_bukti');
            
            $namaFile = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());

            $file->move(public_path('bukti_pengiriman'), $namaFile);

            // Simpan data ke Database
            DetailPengirimanDok::create([
                'id_res_dok' => 'DOK-' . time(),
                'id_pengiriman' => $request->id_pengiriman,
                'id_jenis_dokumen' => $request->jenis_dokumen,
                'tgl_dokumen_diterima' => date('Y-m-d'),
                'file_path' => $namaFile,
            ]);

            return back()->with('success', 'Bukti foto berhasil diunggah!');
        }

        return back()->with('error', 'Gagal mengunggah file.');
    }
}
