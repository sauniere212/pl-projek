<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TemplatePage extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'navbar_id',
        'template_type',
        'judul_halaman',
        'judul_content',
        'isi_content',
        'tanggal',
        'kategori',
        'gambar',
        'penulis',
        'nama_pejabat',
        'jabatan',
        'foto_pejabat',
        'slug',
        'is_active'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'is_active' => 'boolean',
    ];

    protected array $activityLogAttributes = ['judul_halaman', 'judul_content'];

    public function navbar()
    {
        return $this->belongsTo(Navbar::class);
    }

    public function getActivityLogName(): string
    {
        if (!empty($this->template_type)) {
            return 'Template ' . ucwords(str_replace('-', ' ', $this->template_type));
        }

        return 'Template';
    }

    // Auto generate slug saat create/update
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($templatePage) {
            if (empty($templatePage->slug)) {
                $templatePage->slug = Str::slug($templatePage->judul_halaman);
            }
        });

        static::updating(function ($templatePage) {
            if ($templatePage->isDirty('judul_halaman') && empty($templatePage->slug)) {
                $templatePage->slug = Str::slug($templatePage->judul_halaman);
            }
        });
    }

    // Scope untuk template aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope berdasarkan template type
    public function scopeByType($query, $type)
    {
        return $query->where('template_type', $type);
    }
}