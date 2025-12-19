<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CalonKonsumen extends Model
{
    protected $table = 'calon_konsumen';
    protected $primaryKey = 'id_calon_konsumen';
    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'id_calon_konsumen',      
        'id_negara',              
        'nama_calon_konsumen',    
        'email_calon_konsumen',   
        'tgl_pendaftaran',        
    ];

    public function pemesanan(): HasMany
    {
        return $this->hasMany(Pemesanan::class, 'id_calon_konsumen');
    }
}