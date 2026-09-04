<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wilayahKolaborasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'nama_wilayah',
    ];


    public function kolaborasi()
    {
        return $this->hasMany(kolaborasi::class, 'wilayah_kolaborasi_id', 'id');
    }
}
