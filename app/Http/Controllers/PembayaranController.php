<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function create($id_pemesanan)
    {
        $pemesanan = Pemesanan::with('konsumen')->findOrFail($id_pemesanan);
        
        return view('pembayaran.create', compact('pemesanan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pemesanan' => 'required|exists:pemesanan,id_pemesanan',
            'tgl_pembayaran' => 'required|date',
            'jenis_pembayaran' => 'required',
            'total_pembayaran' => 'required|numeric|min:0',
            'bukti_pembayaran' => 'nullable|file|image' 
        ]);

        DB::beginTransaction();

        try {
            Pembayaran::create([
                'id_pembayaran' => 'PAY-' . time(), 
                'id_pemesanan' => $request->id_pemesanan,
                'id_pegawai' => 'PEG001', 
                'tgl_pembayaran' => $request->tgl_pembayaran,
                'jenis_pembayaran' => $request->jenis_pembayaran,
                'total_pembayaran' => $request->total_pembayaran,
                'bukti_pembayaran' => '-', 
            ]);

            $pemesanan = Pemesanan::findOrFail($request->id_pemesanan);
            $pemesanan->update(['status_pemesanan' => 'Lunas']);

            DB::commit();

            return redirect()->route('pemesanan.index')
                             ->with('success', 'Pembayaran Berhasil! Transaksi Lunas.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }

        Pembayaran::create([
                'id_pembayaran' => 'PAY-' . time(),
                'id_pemesanan' => $request->id_pemesanan,
                
                'id_pegawai' => Auth::user()->id_pegawai, 
                
                'tgl_pembayaran' => $request->tgl_pembayaran,
                'jenis_pembayaran' => $request->jenis_pembayaran,
                'total_pembayaran' => $request->total_pembayaran,
                'bukti_pembayaran' => '-', 
            ]);
    }
}