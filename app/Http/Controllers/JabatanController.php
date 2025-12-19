<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatans = Jabatan::all();
        return view('jabatan.index', compact('jabatans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_jabatan' => 'required|unique:jabatan,id_jabatan',
            'nama_jabatan' => 'required'
        ]);

        Jabatan::create($request->all());
        return back()->with('success', 'Jabatan berhasil ditambahkan');
    }

    public function destroy($id)
    {
        Jabatan::findOrFail($id)->delete();
        return back()->with('success', 'Jabatan dihapus');
    }
}