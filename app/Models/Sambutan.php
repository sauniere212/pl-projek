<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sambutan extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'sambutan';
    
    protected $fillable = [
        'isi_sambutan',
        'nama_pejabat',
        'jabatan',
        'foto_pejabat'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
