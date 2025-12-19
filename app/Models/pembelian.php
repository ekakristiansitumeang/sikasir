<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = 'pembelian';
    protected $primaryKey = 'id_pembelian';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_pembelian',
        'tgl_pembelian',
        'id_supplier',
        'id_pegawai',
        'total_biaya'
    ];

    // Relasi ke Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }

    // Relasi ke Pegawai (Admin yang input)
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    // Relasi ke Detail Barang
    public function details()
    {
        return $this->hasMany(DetailPembelian::class, 'id_pembelian');
    }
}