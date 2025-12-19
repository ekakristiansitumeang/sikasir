<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Jabatan; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawais = Pegawai::with('jabatan')->get(); 
        return view('pegawai.index', compact('pegawais'));
    }

    public function create()
    {
        $jabatans = Jabatan::all(); // Ambil data jabatan untuk dropdown
        return view('pegawai.create', compact('jabatans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pegawai' => 'required|unique:pegawai,id_pegawai',
            'nama_pegawai' => 'required',
            'id_jabatan' => 'required',
            'password' => 'required|min:6',
            'status_user' => 'required'
        ]);

        Pegawai::create([
            'id_pegawai' => $request->id_pegawai,
            'nama_pegawai' => $request->nama_pegawai,
            'id_jabatan' => $request->id_jabatan,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'password' => Hash::make($request->password), // Enkripsi Password
            'status_user' => $request->status_user,
        ]);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $jabatans = Jabatan::all();
        return view('pegawai.edit', compact('pegawai', 'jabatans'));
    }

    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);
        
        $data = [
            'nama_pegawai' => $request->nama_pegawai,
            'id_jabatan' => $request->id_jabatan,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'status_user' => $request->status_user,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $pegawai->update($data);

        return redirect()->route('pegawai.index')->with('success', 'Data Pegawai diperbarui');
    }

    public function destroy($id)
    {
        Pegawai::findOrFail($id)->delete();
        return back()->with('success', 'Pegawai dihapus');
    }
}
