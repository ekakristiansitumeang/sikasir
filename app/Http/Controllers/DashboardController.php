<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Barang;
use App\Models\CalonKonsumen;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $hariIni = Carbon::today();
        
        $hariIni = Carbon::today();

        $omsetHariIni = Pemesanan::whereDate('tgl_pemesanan', $hariIni)->sum('total_harga');

        $transaksiHariIni = Pemesanan::whereDate('tgl_pemesanan', $hariIni)->count();

        $barangMenipis = Barang::where('stok_barang', '<', 5)->get();

        $totalKonsumen = CalonKonsumen::count();

        return view('dashboard.index', compact(
            'omsetHariIni', 
            'transaksiHariIni', 
            'barangMenipis', 
            'totalKonsumen'
        ));
        
    }
}