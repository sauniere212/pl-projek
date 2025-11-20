<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'judul',
        'kategori',
        'tanggal',
        'isi',
        'gambar'
    ];

    protected $casts = [
        'tanggal' => 'date'
    ];
}
