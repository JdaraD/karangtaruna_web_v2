<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontakBantuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'wilayah',
        'name',
        'no_hp'
    ];
}
