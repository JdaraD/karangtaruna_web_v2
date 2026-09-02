<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class anggota extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'nama',
        'image',
        'jabatan',
        'tempat_lahir',
        'alamat',
        'no_telp',
        'email',
    ];
}
