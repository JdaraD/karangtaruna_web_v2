<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class video extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'judul_video',
        'album_video_id',
        'link_video',
        'deskripsi_video',
    ];

    public function albumVideo()
    {
        return $this->belongsTo(albumVideo::class, 'album_video_id');
    }
}
