<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'profile';
    
    protected $fillable = [
        'nama',
        'jabatan',
        'deskripsi',
        'foto',
        'email',
        'telepon'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
