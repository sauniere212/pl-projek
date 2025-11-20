<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Carousel;
use App\Models\Navbar;
use Illuminate\Http\Request;

class VideoGaleriController extends Controller
{
    public function index()
    {
        $videoGaleris = Video::orderBy('tanggal', 'desc')->get();
        $carousels = Carousel::where('status', 'Aktif')->orderBy('urutan')->get();
        $navbars = Navbar::with('templatePage')->orderBy('urutan')->get();
        
        return view('galeri-video', compact('videoGaleris', 'carousels', 'navbars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'deskripsi' => 'required|string',
            'url_video' => 'required|string',
            'thumbnail' => 'nullable|string',
            'tanggal' => 'required|date'
        ]);

        Video::create($request->all());

        return response()->json(['success' => true, 'message' => 'Video galeri berhasil disimpan']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string',
            'deskripsi' => 'required|string',
            'url_video' => 'required|string',
            'thumbnail' => 'nullable|string',
            'tanggal' => 'required|date'
        ]);

        $videoGaleri = Video::findOrFail($id);
        $videoGaleri->update($request->all());

        return response()->json(['success' => true, 'message' => 'Video galeri berhasil diupdate']);
    }

    public function destroy($id)
    {
        $videoGaleri = Video::findOrFail($id);
        $videoGaleri->delete();

        return response()->json(['success' => true, 'message' => 'Video galeri berhasil dihapus']);
    }
}
