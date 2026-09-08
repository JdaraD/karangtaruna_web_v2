<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mail extends Model
{
    use HasFactory;

protected $fillable = [
        'nama', 
        'alamat', 
        'email', 
        'no_telp', 
        'keperluan', 
        'tanggal', 
        'detail_keperluan', 
        'file_pdf', 
        'status'
    ];
}
