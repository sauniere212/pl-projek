<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriFoto extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'galeri_foto';
    
    protected $fillable = [
        'judul_album',
        'deskripsi',
        'tanggal',
        'foto'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
