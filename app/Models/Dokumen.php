<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'judul',
        'deskripsi',
        'kategori',
        'file_path'
    ];

    /**
     * Accessor agar view yang masih memakai nama/keterangan/file tetap bekerja
     */
    public function getNamaAttribute()
    {
        return $this->judul;
    }

    public function getKeteranganAttribute()
    {
        return $this->deskripsi;
    }

    public function getFileAttribute()
    {
        return $this->file_path;
    }
}
