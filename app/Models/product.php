<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'nama_produk',
        'deskripsi',
        'gambar',
        'kategori_usaha_id',
    ];


    public function kategoriUsaha()
    {
        return $this->belongsTo(kategoriUsaha::class, 'kategori_usaha_id');
    }
}
