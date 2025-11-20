<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'hari',
        'tanggal',
        'kegiatan'
    ];

    protected $casts = [
        'tanggal' => 'date'
    ];
}
