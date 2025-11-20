<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pejabat extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'nama',
        'jabatan',
        'foto',
        'urutan'
    ];
}
