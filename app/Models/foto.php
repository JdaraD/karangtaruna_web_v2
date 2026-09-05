<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class foto extends Model
{
    use HasFactory;
    
    protected $table = 'fotos';

    protected $fillable = [
        'is_active',
        'album_foto_id',
        'foto',
    ];

    // Banyak foto milik satu album
    public function albumFoto()
    {
        return $this->belongsTo(AlbumFoto::class, 'album_foto_id');
    }
}
