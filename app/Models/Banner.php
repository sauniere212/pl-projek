<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'judul',
        'deskripsi',
        'gambar',
        'urutan',
        'status'
    ];

    protected $casts = [
        'urutan' => 'integer'
    ];
}
