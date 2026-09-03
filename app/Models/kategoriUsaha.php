<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategoriUsaha extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'nama_kategori',
    ];

    public function products()
    {
        return $this->hasMany(product::class, 'kategori_usaha_id');
    }
}
