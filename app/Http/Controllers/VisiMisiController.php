<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Navbar;
use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    public function index()
    {
        $carousels = Carousel::where('status', 'Aktif')->orderBy('urutan')->get();
        $navbars = Navbar::with('templatePage')->orderBy('urutan')->get();
        $visiMisi = VisiMisi::first();
        
        return view('visi-misi', compact('carousels', 'navbars', 'visiMisi'));
    }
}
