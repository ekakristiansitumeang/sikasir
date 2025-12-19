<?php

namespace App\Http\Controllers;

use App\Models\CalonKonsumen; // Pastikan nama Model ini sesuai file Anda
use Illuminate\Http\Request;

class KonsumenController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari tabel 'calon_konsumen'
        $konsumens = CalonKonsumen::all();
        return view('konsumen.index', compact('konsumens'));
    }

    public function create()
    {
        return view('konsumen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_calon_konsumen' => 'required|unique:calon_konsumen,id_calon_konsumen',
            'nama_calon_konsumen' => 'required',
        ]);

        CalonKonsumen::create($request->all());
        return redirect()->route('konsumen.index')->with('success', 'Pelanggan berhasil ditambahkan');
    }

    public function destroy($id)
    {
        CalonKonsumen::findOrFail($id)->delete();
        return back()->with('success', 'Data pelanggan dihapus');
    }

    // Menampilkan Form Edit
    public function edit($id)
    {
        $konsumen = CalonKonsumen::findOrFail($id);
        return view('konsumen.edit', compact('konsumen'));
    }

    // Proses Update Data ke Database
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_calon_konsumen' => 'required',
        ]);

        $konsumen = CalonKonsumen::findOrFail($id);
        
        $konsumen->update([
            'nama_calon_konsumen' => $request->nama_calon_konsumen,
            'alamat_konsumen' => $request->alamat_konsumen,
            'no_telp' => $request->no_telp,
        ]);

        return redirect()->route('konsumen.index')->with('success', 'Data pelanggan berhasil diperbarui');
    }
}