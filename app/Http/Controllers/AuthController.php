<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'id_pegawai' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['id_pegawai' => $request->id_pegawai, 'password' => $request->password])) {
            $request->session()->regenerate();
            
            return redirect()->intended('/dashboard'); 
        }

        return back()->withErrors([
            'id_pegawai' => 'ID Pegawai atau Password salah.',
        ]);
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}