<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal',
        'video_id',
        'url'
    ];

    protected $casts = [
        'tanggal' => 'date'
    ];
}
