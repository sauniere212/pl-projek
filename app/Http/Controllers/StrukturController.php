<?php

namespace App\Http\Controllers;

use App\Models\Struktur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StrukturController extends Controller
{
    public function index()
    {
        $strukturs = Struktur::all();
        $carousels = \App\Models\Carousel::orderBy('urutan')->get();
        return view('struktur.index', compact('strukturs', 'carousels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'struktur_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('struktur_image')) {
            $file = $request->file('struktur_image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            // Simpan file ke storage
            $file->storeAs('public/struktur', $fileName);
            
            // Simpan data ke database
            Struktur::create([
                'gambar' => 'struktur/' . $fileName
            ]);

            return redirect()->route('admin.dashboard')->with('success', 'Struktur organisasi berhasil ditambahkan!')->with('redirect_tab', 'struktur');
        }

        return redirect()->back()->with('error', 'Terjadi kesalahan saat upload file.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'struktur_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $struktur = Struktur::findOrFail($id);

        if ($request->hasFile('struktur_image')) {
            // Hapus file lama
            if (Storage::exists('public/struktur/' . $struktur->gambar)) {
                Storage::delete('public/struktur/' . $struktur->gambar);
            }

            // Upload file baru
            $file = $request->file('struktur_image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/struktur', $fileName);

            // Update database
            $struktur->update([
                'gambar' => 'struktur/' . $fileName
            ]);

            return redirect()->route('admin.dashboard')->with('success', 'Struktur organisasi berhasil diperbarui!')->with('redirect_tab', 'struktur');
        }

        return redirect()->back()->with('error', 'Terjadi kesalahan saat update file.');
    }

    public function destroy($id)
    {
        $struktur = Struktur::findOrFail($id);

        // Hapus file dari storage
        if (Storage::exists('public/struktur/' . $struktur->gambar)) {
            Storage::delete('public/struktur/' . $struktur->gambar);
        }

        // Hapus data dari database
        $struktur->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Struktur organisasi berhasil dihapus!')->with('redirect_tab', 'struktur');
    }
}