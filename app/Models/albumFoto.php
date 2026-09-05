<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class albumFoto extends Model
{
    use HasFactory;

    protected $table = 'album_fotos';

    protected $fillable = [
        'is_active',
        'judul'
    ];

    // Satu album memiliki banyak foto
    public function fotos()
    {
        return $this->hasMany(Foto::class, 'album_foto_id');
    }

    // Helper untuk mengambil foto pertama sebagai sampul/cover
    public function coverFoto()
    {
        return $this->hasOne(Foto::class, 'album_foto_id')->oldest();
    }
}
