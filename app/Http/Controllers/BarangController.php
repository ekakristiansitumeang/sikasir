<?php

namespace App\Http\Controllers;

use App\Models\Barang; 
use App\Http\Controllers\BarangController;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all(); 

        return view('barang.index', compact('barangs'));
    }

    public function show(Barang $barang)
    {
        return view('barang.show', compact('barang'));
    }
    
    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_barang' => 'required|max:30|unique:barang,id_barang',
            'id_jenis_barang' => 'required|max:30', 
            'nama_barang' => 'required|max:255',
            'harga_jual' => 'required|numeric',
            'stok_barang' => 'required|integer|min:0',
           
        ]);

        Barang::create($validated);

        return redirect()->route('barang.index')
                         ->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'id_jenis_barang' => 'required', 
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric', 
            'stok_barang' => 'required|integer',
        ]);
            $barang = Barang::findOrFail($id);
        
            $barang->update([
            'nama_barang' => $request->nama_barang,
            'id_jenis_barang' => $request->id_jenis_barang,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual, 
            'stok_barang' => $request->stok_barang,
        ]);

        return redirect()->route('barang.index')
                         ->with('success', 'Data barang berhasil diperbarui');
    }

    public function destroy($id)
    {
        try {
            $barang = Barang::findOrFail($id);
            $barang->delete();

            return redirect()->route('barang.index')
                             ->with('success', 'Data Barang berhasil dihapus.');

        } catch (\Illuminate\Database\QueryException $e) {
            
            if ($e->getCode() == "23000") {
                return back()->with('error', 'Gagal menghapus! Barang ini sudah ada di riwayat transaksi. Hapus transaksinya dulu atau biarkan saja.');
            }

            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
} 