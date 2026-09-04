<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kolaborasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'nama_kolaborasi',
        'image',
        'wilayah_kolaborasi_id',
        'deskripsi_kolaborasi',
        'tanggal_mulai',
        'tanggal_selesai',
    ];
}
