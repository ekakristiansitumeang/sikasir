<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class UtilitasController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return view('utilitas.index', compact('barangs'));
    }

    public function cekStok(Request $request)
    {
        $id = $request->id_barang;
        
        $result = DB::select("SELECT f_cek_stok(?) AS status", [$id]);
        
        $status = $result[0]->status ?? 'Tidak Diketahui';

        return back()->with('hasil_stok', "Status Stok Barang: " . $status);
    }

    public function cekOmset(Request $request)
    {
        $start = $request->tgl_mulai;
        $end = $request->tgl_selesai;

        $result = DB::select("CALL sp_cek_omset(?, ?)", [$start, $end]);

        $total = $result[0]->total_pendapatan ?? 0;

        return back()->with('hasil_omset', "Total Omset: Rp " . number_format($total, 0, ',', '.'));
    }
}