<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    public function index()
    {
        $jenis = Jenis::all();
        return view('jenis.index', compact('jenis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_jenis' => 'required|unique:jenis,id_jenis',
            'nama_jenis' => 'required'
        ]);

        Jenis::create($request->all());
        return back()->with('success', 'Jenis barang berhasil ditambahkan');
    }

    public function destroy($id)
    {
        Jenis::findOrFail($id)->delete();
        return back()->with('success', 'Jenis barang berhasil dihapus');
    }
}