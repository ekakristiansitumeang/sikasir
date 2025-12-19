<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pemesanan extends Model
{
    protected $table = 'pemesanan';
    protected $primaryKey = 'id_pemesanan'; 
    public $incrementing = false; 
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_pemesanan',
        'id_pegawai',          
        'id_calon_konsumen',   
        'tgl_pemesanan',
        'status_pemesanan',
        'total_biaya_pengiriman',
        'total_harga',
    ];

    public function details(): HasMany
    {
        return $this->hasMany(DetailPemesanan::class, 'id_pemesanan');
    }

    public function konsumen(): BelongsTo
    {
        return $this->belongsTo(CalonKonsumen::class, 'id_calon_konsumen');
    }
    
    public function pengiriman()
    {
        return $this->hasOne(Pengiriman::class, 'id_pemesanan');
    }
}