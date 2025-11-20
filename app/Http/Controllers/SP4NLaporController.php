<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Carousel;
use Illuminate\Http\Request;

class SP4NLaporController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->take(5)->get();
        $carousels = Carousel::where('status', 'Aktif')->orderBy('urutan')->get();
        return view('sp4n-lapor', compact('beritas', 'carousels'));
    }
}
