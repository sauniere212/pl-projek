<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Struktur extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'strukturs';
    protected $fillable = ['gambar'];
}
