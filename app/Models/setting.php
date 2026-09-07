<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'warna_header',
        'warna_runningText',
        'warna_footer'
    ];
}
