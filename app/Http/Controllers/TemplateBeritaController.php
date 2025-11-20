<?php

namespace App\Http\Controllers;

use App\Models\TemplatePage;
use App\Models\Navbar;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class TemplateBeritaController extends Controller
{
    public function index()
    {
        $templatePages = TemplatePage::where('template_type', 'berita')
            ->orderBy('created_at', 'desc')
            ->get();
        
        $navbars = Navbar::with('templatePage')->orderBy('urutan')->get();
        $carousels = Carousel::where('status', 'Aktif')->orderBy('urutan')->get();
        
        return view('admin.template-berita', compact('templatePages', 'navbars', 'carousels'));
    }

    public function show($slug)
    {
        $templatePage = TemplatePage::where('slug', $slug)
            ->where('template_type', 'berita')
            ->where('is_active', true)
            ->firstOrFail();

        // Get data for navbar and carousel
        $navbars = Navbar::with('templatePage')->orderBy('urutan')->get();
        $carousels = Carousel::where('status', 'Aktif')->orderBy('urutan')->get();

        return view('template.berita', compact('templatePage', 'navbars', 'carousels'));
    }

    public function store(Request $request)
    {
        Log::info('Template Berita store request received', $request->all());
        
        $request->validate([
            'judul_halaman' => 'required|string|max:255',
            'judul_content' => 'required|string|max:255',
            'isi_content' => 'required|string',
            'tanggal' => 'required|date',
            'kategori' => 'nullable|string|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'penulis' => 'nullable|string|max:100',
            'navbar_id' => 'required|exists:navbars,id'
        ]);

        $data = $request->all();
        
        // Set template type
        $data['template_type'] = 'berita';
        $data['nama_pejabat'] = null;
        $data['jabatan'] = null;
        $data['foto_pejabat'] = null;
        
        // Handle file upload untuk gambar
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambarName = time() . '_' . $gambar->getClientOriginalName();
            $gambarPath = $gambar->storeAs('public/template-berita', $gambarName);
            $data['gambar'] = 'template-berita/' . $gambarName;
            Log::info('Gambar uploaded', ['path' => $data['gambar']]);
        }

        // Generate slug
        $data['slug'] = Str::slug($data['judul_halaman']);

        try {
            // Create template page
            $templatePage = TemplatePage::create($data);

            // Update navbar with template_page_id
            $navbar = Navbar::find($request->navbar_id);
            $navbar->update(['template_page_id' => $templatePage->id]);

            Log::info('Template berita created successfully', ['id' => $templatePage->id]);

            return response()->json([
                'success' => true,
                'message' => 'Template berita berhasil disimpan!',
                'data' => $templatePage
            ]);
        } catch (\Exception $e) {
            Log::error('Error creating template berita', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan template berita!'
            ], 500);
        }
    }

    public function edit($id)
    {
        $templatePage = TemplatePage::where('id', $id)
            ->where('template_type', 'berita')
            ->firstOrFail();
        
        return response()->json($templatePage);
    }

    public function update(Request $request, $id)
    {
        $templatePage = TemplatePage::where('id', $id)
            ->where('template_type', 'berita')
            ->firstOrFail();

        $request->validate([
            'judul_halaman' => 'required|string|max:255',
            'judul_content' => 'required|string|max:255',
            'isi_content' => 'required|string',
            'tanggal' => 'required|date',
            'kategori' => 'nullable|string|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'penulis' => 'nullable|string|max:100',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($data['judul_halaman']);

        // Handle file upload untuk gambar
        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($templatePage->gambar) {
                Storage::delete('public/' . $templatePage->gambar);
            }
            
            $gambar = $request->file('gambar');
            $gambarName = time() . '_' . $gambar->getClientOriginalName();
            $gambarPath = $gambar->storeAs('public/template-berita', $gambarName);
            $data['gambar'] = 'template-berita/' . $gambarName;
        }

        $templatePage->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Template berita berhasil diupdate!'
        ]);
    }

    public function destroy($id)
    {
        $templatePage = TemplatePage::where('id', $id)
            ->where('template_type', 'berita')
            ->firstOrFail();

        // Delete associated image
        if ($templatePage->gambar) {
            Storage::delete('public/' . $templatePage->gambar);
        }

        // Remove template_page_id from navbar
        Navbar::where('template_page_id', $templatePage->id)->update(['template_page_id' => null]);

        $templatePage->delete();

        return response()->json([
            'success' => true,
            'message' => 'Template berita berhasil dihapus!'
        ]);
    }

    public function toggleStatus($id)
    {
        $templatePage = TemplatePage::where('id', $id)
            ->where('template_type', 'berita')
            ->firstOrFail();

        $templatePage->update(['is_active' => !$templatePage->is_active]);

        return response()->json([
            'success' => true,
            'message' => 'Status template berita berhasil diubah!',
            'is_active' => $templatePage->is_active
        ]);
    }
}
