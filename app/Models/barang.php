<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Barang extends Model
{
    protected $table = 'barang';
    
    protected $primaryKey = 'id_barang';
    public $incrementing = false; 
    protected $keyType = 'string';
    
    public $timestamps = false;

    protected $fillable = [
        'id_barang', 
        'id_jenis_barang', 
        'nama_barang', 
        'harga_beli',   
        'harga_jual',   
        'stok_barang'
    ];

    public function jenisBarang(): BelongsTo
    {
        return $this->belongsTo(JenisBarang::class, 'id_jenis_barang');
    }
}