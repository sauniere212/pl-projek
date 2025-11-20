<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Dokumen;
use App\Models\Profile;
use App\Models\Sambutan;
use App\Models\Carousel;
use App\Models\Navbar;
use App\Models\GaleriFoto;
use App\Models\VideoGaleri;

class PublicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Halaman utama - redirect ke HomeController
        return redirect()->route('home');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tidak digunakan untuk halaman publik
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Tidak digunakan untuk halaman publik
        abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Tidak digunakan untuk halaman publik
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Tidak digunakan untuk halaman publik
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Tidak digunakan untuk halaman publik
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Tidak digunakan untuk halaman publik
        abort(404);
    }
}
