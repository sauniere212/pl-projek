<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'kegiatan',
        'tempat',
        'tanggal',
        'waktu'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'waktu' => 'datetime'
    ];
}
