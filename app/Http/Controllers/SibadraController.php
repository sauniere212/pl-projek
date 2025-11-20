<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Carousel;
use Illuminate\Http\Request;

class SibadraController extends Controller
{
    public function index()
    {
   
        $carousels = Carousel::where('status', 'Aktif')->orderBy('urutan')->get();

       
        $beritas = Berita::latest()->take(5)->get();

       
        return view('sibadra', compact('carousels', 'beritas'));
    }
}
