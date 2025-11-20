<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal',
        'foto'
    ];

    protected $casts = [
        'tanggal' => 'date'
    ];
}
