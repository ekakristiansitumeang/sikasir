<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    protected $table = 'detail_pembelian';
    protected $primaryKey = 'id_detail_beli';
    public $timestamps = false;

    protected $fillable = [
        'id_pembelian',
        'id_barang',
        'harga_beli_satuan',
        'jumlah_beli'
    ];

    // Relasi ke Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}