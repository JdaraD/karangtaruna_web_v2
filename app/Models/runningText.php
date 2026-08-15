<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class runningText extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'judul',
        'text',
        'created_at',
        'updated_at'
    ];
}
