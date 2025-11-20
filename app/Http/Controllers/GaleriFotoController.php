<?php

namespace App\Http\Controllers;

use App\Models\GaleriFoto;
use App\Models\Carousel;
use App\Models\Navbar;
use Illuminate\Http\Request;

class GaleriFotoController extends Controller
{
    public function index()
    {
        $galeriFotos = GaleriFoto::orderBy('tanggal', 'desc')->get();
        $carousels = Carousel::where('status', 'Aktif')->orderBy('urutan')->get();
        $navbars = Navbar::with('templatePage')->orderBy('urutan')->get();
        
        return view('galeri-foto', compact('galeriFotos', 'carousels', 'navbars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_album' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        
        // Handle file upload
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            
            // Convert to base64 for storage (as per original requirement)
            $fotoBase64 = base64_encode(file_get_contents($foto));
            $data['foto'] = 'data:' . $foto->getMimeType() . ';base64,' . $fotoBase64;
        }

        GaleriFoto::create($data);

        return response()->json([
            'success' => true, 
            'message' => 'Foto galeri berhasil diupload'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_album' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $galeriFoto = GaleriFoto::findOrFail($id);
        $data = $request->all();
        
        // Handle file upload
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            
            // Convert to base64 for storage (as per original requirement)
            $fotoBase64 = base64_encode(file_get_contents($foto));
            $data['foto'] = 'data:' . $foto->getMimeType() . ';base64,' . $fotoBase64;
        }

        $galeriFoto->update($data);

        return response()->json([
            'success' => true, 
            'message' => 'Foto galeri berhasil diupdate'
        ]);
    }

    public function destroy($id)
    {
        $galeriFoto = GaleriFoto::findOrFail($id);
        $galeriFoto->delete();

        return response()->json(['success' => true, 'message' => 'Foto galeri berhasil dihapus']);
    }
}
