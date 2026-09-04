<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class albumVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'nama_album',
    ];

    public function video()
    {
        return $this->hasMany(video::class, 'album_video_id');
    }
}
