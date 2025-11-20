<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::orderBy('tanggal', 'desc')->get();
        return response()->json($galeris);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'foto' => 'required|string'
        ]);

        $galeri = Galeri::create($request->all());
        return response()->json($galeri, 201);
    }

    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'foto' => 'nullable|string'
        ]);

        $galeri->update($request->all());
        return response()->json($galeri);
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);
        $galeri->delete();

        return redirect()->back()->with('success', 'Foto galeri berhasil dihapus!')->with('redirect_tab', 'galeri');
    }
}
