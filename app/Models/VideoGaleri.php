<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoGaleri extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'video_galeri';
    
    protected $fillable = [
        'judul',
        'deskripsi',
        'url_video',
        'thumbnail',
        'tanggal'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
