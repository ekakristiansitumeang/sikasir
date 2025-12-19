<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPengirimanDok extends Model
{
    protected $table = 'detail_pengiriman_dok';
    protected $primaryKey = 'id_res_dok'; // Sesuai tabel
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_res_dok',
        'id_pengiriman',
        'id_jenis_dokumen',    // Kolom baru
        'tgl_dokumen_diterima', // Kolom baru
        'file_path',           // Sesuai tabel
    ];

    public function pengiriman()
    {
        return $this->belongsTo(Pengiriman::class, 'id_pengiriman');
    }
}