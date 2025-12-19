<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CalonKonsumenController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\JenisController; 
use App\Http\Controllers\PegawaiController;   
use App\Http\Controllers\KonsumenController; 
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\UtilitasController;



Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('barang', BarangController::class);
    Route::resource('konsumen', CalonKonsumenController::class);
    Route::resource('pemesanan', PemesananController::class);

    Route::get('/pembayaran/bayar/{id_pemesanan}', [PembayaranController::class, 'create'])->name('pembayaran.create');
    Route::post('/pembayaran/simpan', [PembayaranController::class, 'store'])->name('pembayaran.store');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::resource('pengiriman', PengirimanController::class)->only(['index', 'store', 'show']);

    Route::post('/pengiriman/upload', [PengirimanController::class, 'uploadBukti'])->name('pengiriman.upload');
    Route::resource('jabatan', App\Http\Controllers\JabatanController::class);
    Route::resource('supplier', App\Http\Controllers\SupplierController::class);
    Route::resource('jenis', JenisController::class);

    Route::resource('pegawai', PegawaiController::class);
    Route::resource('konsumen', KonsumenController::class);
    Route::resource('pembelian', PembelianController::class);

    Route::get('/cek-data', [UtilitasController::class, 'index'])->name('utilitas.index');
    Route::post('/cek-stok', [UtilitasController::class, 'cekStok'])->name('utilitas.stok');
    Route::post('/cek-omset', [UtilitasController::class, 'cekOmset'])->name('utilitas.omset');
    });