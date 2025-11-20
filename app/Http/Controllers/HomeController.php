<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Carousel;
use App\Models\Navbar;
use App\Models\Calendar;
use App\Models\Agenda;
use App\Models\Banner;
use App\Models\Sambutan;
use App\Models\GaleriFoto;
use App\Models\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $carousels = Carousel::where('status', 'Aktif')->orderBy('urutan')->get();
        $navbars = Navbar::with('templatePage')->where('is_active', true)->orderBy('urutan')->get();
        
        // Data untuk halaman home
        $beritas = Berita::latest()->take(3)->get();
        $calendars = Calendar::latest()->take(5)->get();
        $agendas = Agenda::latest()->take(5)->get();
        $banners = Banner::orderBy('urutan')->get();
        $sambutan = Sambutan::first();
        $galeris = GaleriFoto::latest()->take(6)->get();
        $videos = Video::latest()->take(4)->get();
        
        return view('home', compact('carousels', 'navbars', 'beritas', 'calendars', 'agendas', 'banners', 'sambutan', 'galeris', 'videos'));
    }
}
