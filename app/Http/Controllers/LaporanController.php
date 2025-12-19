<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class LaporanController extends Controller
{
    public function index()
    {
        $laporan = DB::table('view_detail_pemesanan_lengkap')
                    ->orderBy('tgl_pemesanan', 'desc')
                    ->get();

        return view('laporan.index', compact('laporan'));
    }
}