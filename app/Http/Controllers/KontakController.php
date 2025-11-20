<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Navbar;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        $carousels = Carousel::where('status', 'Aktif')->orderBy('urutan')->get();
        $navbars = Navbar::with('templatePage')->orderBy('urutan')->get();
        
        return view('kontak', compact('carousels', 'navbars'));
    }
}
