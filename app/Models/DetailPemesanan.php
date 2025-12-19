<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailPemesanan extends Model
{
    protected $table = 'detail_pemesanan'; 
    
    protected $primaryKey = 'id_detail_pemesanan';
    public $incrementing = false; 
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_detail_pemesanan', // PK Manual
        'id_pemesanan',        // FK
        'id_barang',           // FK
        'jumlah_barang',       // Sesuai gambar
        'sub_total',           // Sesuai gambar
        'total_berat',         // Opsional
    ];

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function pemesanan(): BelongsTo
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan');
    }
}