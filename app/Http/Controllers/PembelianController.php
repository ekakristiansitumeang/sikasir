<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\DetailPembelian;
use App\Models\Supplier;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    // 1. Halaman Riwayat Pembelian
    public function index()
    {
        $pembelians = Pembelian::with(['supplier', 'pegawai'])
                        ->orderBy('tgl_pembelian', 'desc')
                        ->get();
        return view('pembelian.index', compact('pembelians'));
    }

    // 2. Form Tambah Stok (Kulakan)
    public function create()
    {
        $suppliers = Supplier::all();
        $barangs = Barang::all();
        // Generate ID Otomatis: BL-Timestamp
        $newId = 'BL-' . time();
        
        return view('pembelian.create', compact('suppliers', 'barangs', 'newId'));
    }

    // 3. Proses Simpan ke Database
    public function store(Request $request)
    {
        $request->validate([
            'id_pembelian' => 'required|unique:pembelian,id_pembelian',
            'id_supplier' => 'required',
            'barang_id' => 'required|array', // Harus berupa array (banyak barang)
            'barang_id.*' => 'required',
            'jumlah' => 'required|array',
            'harga' => 'required|array',
        ]);

        try {
            DB::beginTransaction(); // Mulai Transaksi Database

            // Hitung Total Biaya
            $totalBiaya = 0;
            foreach ($request->jumlah as $key => $qty) {
                $totalBiaya += $qty * $request->harga[$key];
            }

            // A. Simpan Header Pembelian
            Pembelian::create([
                'id_pembelian' => $request->id_pembelian,
                'tgl_pembelian' => now(),
                'id_supplier' => $request->id_supplier,
                'id_pegawai' => Auth::user()->id_pegawai, // Admin yang login
                'total_biaya' => $totalBiaya,
            ]);

            // B. Simpan Detail Barang (Looping Array)
            foreach ($request->barang_id as $key => $idBarang) {
                if($idBarang && $request->jumlah[$key] > 0) {
                    DetailPembelian::create([
                        'id_pembelian' => $request->id_pembelian,
                        'id_barang' => $idBarang,
                        'harga_beli_satuan' => $request->harga[$key],
                        'jumlah_beli' => $request->jumlah[$key],
                    ]);
                }
            }

            DB::commit(); 
            return redirect()->route('pembelian.index')->with('success', 'Stok berhasil ditambahkan!');

        } catch (\Exception $e) {
            DB::rollBack(); 
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $pembelian = Pembelian::with(['details.barang', 'supplier', 'pegawai'])->findOrFail($id);
        return view('pembelian.show', compact('pembelian'));
    }
}