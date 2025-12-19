<?php

namespace App\Http\Controllers;

use App\Models\CalonKonsumen;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CalonKonsumenController extends Controller
{
    public function index()
    {
        $konsumens = CalonKonsumen::all();
        return view('konsumen.index', compact('konsumens'));
    }

    public function create()
    {
        return view('konsumen.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_calon_konsumen' => 'required|max:50|unique:calon_konsumen,id_calon_konsumen',
            'nama_calon_konsumen' => 'required|max:100',
            'email_calon_konsumen' => 'nullable|email|max:100', 
            'id_negara' => 'nullable|max:30',
            'tgl_pendaftaran' => 'nullable|date',
        ]);

        CalonKonsumen::create($validated);

        return redirect()->route('konsumen.index')
                         ->with('success', 'Data Calon Konsumen berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $konsumen = CalonKonsumen::findOrFail($id);
        return view('konsumen.edit', compact('konsumen'));
    }

    public function update(Request $request, $id)
    {
        $konsumen = CalonKonsumen::findOrFail($id);

        $validated = $request->validate([
            'id_calon_konsumen' => [
                'required',
                'max:50',
                Rule::unique('calon_konsumen', 'id_calon_konsumen')->ignore($konsumen->id_calon_konsumen, 'id_calon_konsumen'),
            ],
            'nama_calon_konsumen' => 'required|max:100',
            'email_calon_konsumen' => 'nullable|email|max:100',
            'id_negara' => 'nullable|max:30',
            'tgl_pendaftaran' => 'nullable|date',
        ]);

        $konsumen->update($validated);

        return redirect()->route('konsumen.index')
                         ->with('success', 'Data Konsumen berhasil diperbarui.');
    }

    public function destroy($id)
    {
        try {
            $konsumen = CalonKonsumen::findOrFail($id);
            $konsumen->delete();

            return redirect()->route('konsumen.index')
                             ->with('success', 'Data Pelanggan berhasil dihapus.');

        } catch (\Illuminate\Database\QueryException $e) {
            
            if ($e->getCode() == "23000") {
                return back()->with('error', 'Gagal menghapus! Pelanggan ini memiliki riwayat transaksi. Hapus transaksinya dulu jika ingin menghapus pelanggan ini.');
            }

            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}