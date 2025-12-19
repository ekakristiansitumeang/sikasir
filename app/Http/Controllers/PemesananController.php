<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\DetailPemesanan;
use App\Models\Barang;
use App\Models\CalonKonsumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller
{
    public function index()
    {
        $pemesanans = Pemesanan::with('konsumen')->get();
        return view('pemesanan.index', compact('pemesanans'));
    }

    public function create()
    {
        $konsumens = CalonKonsumen::all();
        $barangs = Barang::all(); 
        return view('pemesanan.create', compact('konsumens', 'barangs'));
    }

    public function show($id)
    {
        $pemesanan = Pemesanan::with(['konsumen', 'details.barang'])->findOrFail($id);

        return view('pemesanan.show', compact('pemesanan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_calon_konsumen' => 'required|exists:calon_konsumen,id_calon_konsumen',
            'tgl_pemesanan' => 'required|date',
            'total_biaya_pengiriman' => 'required|numeric|min:0',
            'items' => 'required|array|min:1',
            'items.*.id_barang' => 'required|exists:barang,id_barang',
            'items.*.jumlah_barang' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $idPemesanan = 'TRX-' . time(); 
            
            $totalHargaBarang = 0;
            $itemsToInsert = [];

            foreach ($request->items as $item) {
                $barang = Barang::findOrFail($item['id_barang']);
                
                if ($barang->stok_barang < $item['jumlah_barang']) {
                    throw new \Exception("Stok barang {$barang->nama_barang} tidak mencukupi!");
                }

                $subTotal = $barang->harga_jual * $item['jumlah_barang'];
                $totalHargaBarang += $subTotal;

                $itemsToInsert[] = [
                    'barang' => $barang, 
                    'jumlah_barang' => $item['jumlah_barang'],
                    'sub_total' => $subTotal,
                ];
            }

            $grandTotal = $totalHargaBarang + $request->total_biaya_pengiriman;

            Pemesanan::create([
                'id_pemesanan' => $idPemesanan,
                'id_pegawai' => 'PEG001', 
                'id_calon_konsumen' => $request->id_calon_konsumen,
                'tgl_pemesanan' => $request->tgl_pemesanan,
                'status_pemesanan' => 'Baru', 
                'total_biaya_pengiriman' => $request->total_biaya_pengiriman,
                'total_harga' => $grandTotal,
            ]);

            foreach ($itemsToInsert as $data) {
                DetailPemesanan::create([
                    'id_detail_pemesanan' => 'DTL-' . Str::random(10), 
                    'id_pemesanan' => $idPemesanan,
                    'id_barang' => $data['barang']->id_barang,
                    'jumlah_barang' => $data['jumlah_barang'],
                    'sub_total' => $data['sub_total'],
                    'total_berat' => 0, 
                ]);
            }

            DB::commit(); 

            return redirect()->route('pemesanan.index')->with('success', 'Transaksi Berhasil Disimpan! ID: ' . $idPemesanan);

        } catch (\Exception $e) {
            DB::rollBack(); 
            return back()->with('error', 'Gagal menyimpan transaksi: ' . $e->getMessage());
        }

        Pemesanan::create([
                'id_pemesanan' => $idPemesanan,
                
                'id_pegawai' => Auth::user()->id_pegawai, 
                
                'id_calon_konsumen' => $request->id_calon_konsumen,
                'tgl_pemesanan' => $request->tgl_pemesanan,
                'status_pemesanan' => 'Baru',
                'total_biaya_pengiriman' => $request->total_biaya_pengiriman,
                'total_harga' => $grandTotal,
            ]);
    }

    public function destroy($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        
        DB::beginTransaction();
        try {

            DetailPemesanan::where('id_pemesanan', $id)->delete();
            
            \App\Models\Pembayaran::where('id_pemesanan', $id)->delete();

            $pemesanan->delete();

            DB::commit();
            return redirect()->route('pemesanan.index')->with('success', 'Transaksi Dibatalkan & Stok Dikembalikan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal membatalkan transaksi: ' . $e->getMessage());
        }
    }
}