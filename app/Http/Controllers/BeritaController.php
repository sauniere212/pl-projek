<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Carousel;
use App\Models\Navbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::orderBy('tanggal', 'desc')->get();
        $carousels = Carousel::where('status', 'Aktif')->orderBy('urutan')->get();
        $navbars = Navbar::with('templatePage')->orderBy('urutan')->get();

        return view('berita', compact('beritas', 'carousels', 'navbars'));
    }

    public function adminIndex()
    {
        $beritas = Berita::orderBy('tanggal', 'desc')->get();
        return view('admin.berita.index', compact('beritas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'isi' => 'required|string'
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambarName = time() . '_' . $gambar->getClientOriginalName();

            // Convert to base64 for storage (as per original requirement)
            $gambarBase64 = base64_encode(file_get_contents($gambar));
            $data['gambar'] = 'data:' . $gambar->getMimeType() . ';base64,' . $gambarBase64;
        }

        Berita::create($data);

        return redirect()->back()->with('success', 'Berita berhasil disimpan!')->with('redirect_tab', 'berita');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return response()->json([
            'success' => true,
            'berita' => $berita
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'isi' => 'required|string'
        ]);

        $berita = Berita::findOrFail($id);
        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambarName = time() . '_' . $gambar->getClientOriginalName();

            // Convert to base64 for storage (as per original requirement)
            $gambarBase64 = base64_encode(file_get_contents($gambar));
            $data['gambar'] = 'data:' . $gambar->getMimeType() . ';base64,' . $gambarBase64;
        }

        $berita->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil diupdate!'
        ]);
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();

        return redirect()->back()->with('success', 'Berita berhasil dihapus!')->with('redirect_tab', 'berita');
    }

    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        $carousels = Carousel::where('status', 'Aktif')->orderBy('urutan')->get();
        $navbars = Navbar::with('templatePage')->orderBy('urutan')->get();
        
        // Get related berita (berita lain dengan kategori yang sama)
        $relatedBeritas = Berita::where('kategori', $berita->kategori)
            ->where('id', '!=', $berita->id)
            ->orderBy('tanggal', 'desc')
            ->take(3)
            ->get();

        return view('berita-detail', compact('berita', 'carousels', 'navbars', 'relatedBeritas'));
    }
}
