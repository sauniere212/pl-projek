<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navbar extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'nama',
        'icon',
        'link',
        'is_dropdown',
        'sub_menu',
        'urutan',
        'is_active',
        'template_page_id'
    ];

    protected $casts = [
        'is_dropdown' => 'boolean',
        'sub_menu' => 'array',
        'is_active' => 'boolean'
    ];

    public function templatePage()
    {
        return $this->hasOne(TemplatePage::class, 'navbar_id');
    }
}
