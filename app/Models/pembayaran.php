<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    public $incrementing = false; // Karena Varchar
    protected $keyType = 'string';
    public $timestamps = false; // Tidak ada created_at/updated_at

    protected $fillable = [
        'id_pembayaran',
        'id_pemesanan',
        'id_pegawai',
        'tgl_pembayaran',
        'bukti_pembayaran',
        'jenis_pembayaran',
        'total_pembayaran',
    ];

    // Relasi ke Pemesanan
    public function pemesanan(): BelongsTo
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan');
    }
}