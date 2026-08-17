<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kontakAdmin extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'name',
        'gmail',
        'no_hp',
    ];
}
