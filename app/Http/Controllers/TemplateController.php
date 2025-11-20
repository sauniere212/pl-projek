<?php

namespace App\Http\Controllers;

use App\Models\TemplatePage;
use App\Models\Navbar;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TemplateController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'template_type' => 'required|in:berita,sambutan',
            'judul_halaman' => 'required|string|max:255',
            'judul_content' => 'required|string|max:255',
            'isi_content' => 'required|string',
            'tanggal' => 'required|date',
            'kategori' => 'nullable|string|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'penulis' => 'nullable|string|max:100',
            'nama_pejabat' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'foto_pejabat' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'navbar_id' => 'required|exists:navbars,id'
        ]);

        $data = $request->all();
        
        // Handle file uploads
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambarName = time() . '_' . $gambar->getClientOriginalName();
            $folderName = $data['template_type'] === 'berita' ? 'template-berita' : 'template-sambutan';
            $gambarPath = $gambar->storeAs('public/' . $folderName, $gambarName);
            $data['gambar'] = $folderName . '/' . $gambarName;
        }

        if ($request->hasFile('foto_pejabat')) {
            $foto = $request->file('foto_pejabat');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $folderName = $data['template_type'] === 'berita' ? 'template-berita' : 'template-sambutan';
            $fotoPath = $foto->storeAs('public/' . $folderName, $fotoName);
            $data['foto_pejabat'] = $folderName . '/' . $fotoName;
        }

        // Generate slug
        $data['slug'] = Str::slug($data['judul_halaman']);

        // Create template page
        $templatePage = TemplatePage::create($data);

        // Update navbar with template_page_id
        $navbar = Navbar::find($request->navbar_id);
        $navbar->update(['template_page_id' => $templatePage->id]);

        return response()->json([
            'success' => true,
            'message' => 'Template berhasil disimpan!',
            'data' => $templatePage
        ]);
    }

    public function show($slug)
    {
        $templatePage = TemplatePage::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Get data for navbar and carousel
        $navbars = Navbar::with('templatePage')->orderBy('urutan')->get();
        $carousels = Carousel::where('status', 'Aktif')->orderBy('urutan')->get();

        // Determine which template to use
        $templateView = $templatePage->template_type === 'berita' 
            ? 'template.berita' 
            : 'template.sambutan';

        return view($templateView, compact('templatePage', 'navbars', 'carousels'));
    }

    public function edit($id)
    {
        $templatePage = TemplatePage::findOrFail($id);
        return response()->json($templatePage);
    }

    public function update(Request $request, $id)
    {
        $templatePage = TemplatePage::findOrFail($id);

        $request->validate([
            'template_type' => 'required|in:berita,sambutan',
            'judul_halaman' => 'required|string|max:255',
            'judul_content' => 'required|string|max:255',
            'isi_content' => 'required|string',
            'tanggal' => 'required|date',
            'kategori' => 'nullable|string|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'penulis' => 'nullable|string|max:100',
            'nama_pejabat' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'foto_pejabat' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Handle file uploads
        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($templatePage->gambar) {
                Storage::delete('public/' . $templatePage->gambar);
            }
            
            $gambar = $request->file('gambar');
            $gambarName = time() . '_' . $gambar->getClientOriginalName();
            $folderName = $data['template_type'] === 'berita' ? 'template-berita' : 'template-sambutan';
            $gambarPath = $gambar->storeAs('public/' . $folderName, $gambarName);
            $data['gambar'] = $folderName . '/' . $gambarName;
        }

        if ($request->hasFile('foto_pejabat')) {
            // Delete old image
            if ($templatePage->foto_pejabat) {
                Storage::delete('public/' . $templatePage->foto_pejabat);
            }
            
            $foto = $request->file('foto_pejabat');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $folderName = $data['template_type'] === 'berita' ? 'template-berita' : 'template-sambutan';
            $fotoPath = $foto->storeAs('public/' . $folderName, $fotoName);
            $data['foto_pejabat'] = $folderName . '/' . $fotoName;
        }

        // Update slug if judul_halaman changed
        if ($templatePage->judul_halaman !== $data['judul_halaman']) {
            $data['slug'] = Str::slug($data['judul_halaman']);
        }

        $templatePage->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Template berhasil diupdate!',
            'data' => $templatePage
        ]);
    }

    public function destroy($id)
    {
        $templatePage = TemplatePage::findOrFail($id);

        // Delete associated files
        if ($templatePage->gambar) {
            Storage::delete('public/' . $templatePage->gambar);
        }
        if ($templatePage->foto_pejabat) {
            Storage::delete('public/' . $templatePage->foto_pejabat);
        }

        // Update navbar to remove template_page_id
        $navbar = $templatePage->navbar;
        if ($navbar) {
            $navbar->update(['template_page_id' => null]);
        }

        $templatePage->delete();

        return response()->json([
            'success' => true,
            'message' => 'Template berhasil dihapus!'
        ]);
    }
}