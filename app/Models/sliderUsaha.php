<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sliderUsaha extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'name',
        'image',
        'tanggal_publish'
    ];
}
