<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'judul',
        'deskripsi',
        'urutan',
        'gambar',
        'status'
    ];

    /**
     * Get the image URL for display
     * Handles both file path and base64 formats
     */
    public function getImageUrlAttribute()
    {
        if (empty($this->gambar)) {
            return null;
        }

        // Check if it's a base64 image
        if (strpos($this->gambar, 'data:image') === 0) {
            return $this->gambar;
        }

        // Check if it's a file path
        if (strpos($this->gambar, 'carousel/') === 0) {
            return asset('storage/' . $this->gambar);
        }

        // If it's just a filename, assume it's in carousel folder
        return asset('storage/carousel/' . $this->gambar);
    }
}
