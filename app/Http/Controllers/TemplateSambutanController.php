<?php

namespace App\Http\Controllers;

use App\Models\TemplatePage;
use App\Models\Navbar;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class TemplateSambutanController extends Controller
{
    public function index()
    {
        $templatePages = TemplatePage::where('template_type', 'sambutan')
            ->orderBy('created_at', 'desc')
            ->get();
        
        $navbars = Navbar::with('templatePage')->orderBy('urutan')->get();
        $carousels = Carousel::where('status', 'Aktif')->orderBy('urutan')->get();
        
        return view('admin.template-sambutan', compact('templatePages', 'navbars', 'carousels'));
    }

    public function show($slug)
    {
        $templatePage = TemplatePage::where('slug', $slug)
            ->where('template_type', 'sambutan')
            ->where('is_active', true)
            ->firstOrFail();

        // Get data for navbar and carousel
        $navbars = Navbar::with('templatePage')->orderBy('urutan')->get();
        $carousels = Carousel::where('status', 'Aktif')->orderBy('urutan')->get();

        return view('template.sambutan', compact('templatePage', 'navbars', 'carousels'));
    }

    public function store(Request $request)
    {
        Log::info('Template Sambutan store request received', $request->all());
        
        $request->validate([
            'judul_halaman' => 'required|string|max:255',
            'isi_content' => 'required|string',
            'tanggal' => 'required|date',
            'nama_pejabat' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto_pejabat' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'navbar_id' => 'required|exists:navbars,id'
        ]);

        $data = $request->all();
        
        // Set template type
        $data['template_type'] = 'sambutan';
        $data['judul_content'] = $data['judul_halaman']; // Untuk sambutan, gunakan judul_halaman sebagai judul_content
        $data['kategori'] = null;
        $data['penulis'] = null;
        $data['gambar'] = null;
        
        // Handle file upload untuk foto_pejabat
        if ($request->hasFile('foto_pejabat')) {
            $foto = $request->file('foto_pejabat');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $fotoPath = $foto->storeAs('public/template-sambutan', $fotoName);
            $data['foto_pejabat'] = 'template-sambutan/' . $fotoName;
            
            // Copy file ke folder public untuk akses langsung
            $publicPath = public_path('storage/template-sambutan/' . $fotoName);
            if (!file_exists(public_path('storage/template-sambutan'))) {
                mkdir(public_path('storage/template-sambutan'), 0755, true);
            }
            copy(storage_path('app/public/template-sambutan/' . $fotoName), $publicPath);
            
            Log::info('Foto pejabat uploaded', ['path' => $data['foto_pejabat']]);
        }

        // Generate slug
        $data['slug'] = Str::slug($data['judul_halaman']);

        try {
            // Create template page
            $templatePage = TemplatePage::create($data);

            // Update navbar with template_page_id
            $navbar = Navbar::find($request->navbar_id);
            $navbar->update(['template_page_id' => $templatePage->id]);

            Log::info('Template sambutan created successfully', ['id' => $templatePage->id]);

            return response()->json([
                'success' => true,
                'message' => 'Template sambutan berhasil disimpan!',
                'data' => $templatePage
            ]);
        } catch (\Exception $e) {
            Log::error('Error creating template sambutan', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan template sambutan!'
            ], 500);
        }
    }

    public function edit($id)
    {
        $templatePage = TemplatePage::where('id', $id)
            ->where('template_type', 'sambutan')
            ->firstOrFail();
        
        return response()->json($templatePage);
    }

    public function update(Request $request, $id)
    {
        $templatePage = TemplatePage::where('id', $id)
            ->where('template_type', 'sambutan')
            ->firstOrFail();

        $request->validate([
            'judul_halaman' => 'required|string|max:255',
            'isi_content' => 'required|string',
            'tanggal' => 'required|date',
            'nama_pejabat' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto_pejabat' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        $data['judul_content'] = $data['judul_halaman'];
        $data['slug'] = Str::slug($data['judul_halaman']);

        // Handle file upload untuk foto_pejabat
        if ($request->hasFile('foto_pejabat')) {
            // Delete old image
            if ($templatePage->foto_pejabat) {
                Storage::delete('public/' . $templatePage->foto_pejabat);
                // Delete from public folder too
                $oldPublicPath = public_path('storage/' . $templatePage->foto_pejabat);
                if (file_exists($oldPublicPath)) {
                    unlink($oldPublicPath);
                }
            }
            
            $foto = $request->file('foto_pejabat');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $fotoPath = $foto->storeAs('public/template-sambutan', $fotoName);
            $data['foto_pejabat'] = 'template-sambutan/' . $fotoName;
            
            // Copy file ke folder public untuk akses langsung
            $publicPath = public_path('storage/template-sambutan/' . $fotoName);
            if (!file_exists(public_path('storage/template-sambutan'))) {
                mkdir(public_path('storage/template-sambutan'), 0755, true);
            }
            copy(storage_path('app/public/template-sambutan/' . $fotoName), $publicPath);
        }

        $templatePage->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Template sambutan berhasil diupdate!'
        ]);
    }

    public function destroy($id)
    {
        $templatePage = TemplatePage::where('id', $id)
            ->where('template_type', 'sambutan')
            ->firstOrFail();

        // Delete associated image
        if ($templatePage->foto_pejabat) {
            Storage::delete('public/' . $templatePage->foto_pejabat);
            // Delete from public folder too
            $publicPath = public_path('storage/' . $templatePage->foto_pejabat);
            if (file_exists($publicPath)) {
                unlink($publicPath);
            }
        }

        // Remove template_page_id from navbar
        Navbar::where('template_page_id', $templatePage->id)->update(['template_page_id' => null]);

        $templatePage->delete();

        return response()->json([
            'success' => true,
            'message' => 'Template sambutan berhasil dihapus!'
        ]);
    }

    public function toggleStatus($id)
    {
        $templatePage = TemplatePage::where('id', $id)
            ->where('template_type', 'sambutan')
            ->firstOrFail();

        $templatePage->update(['is_active' => !$templatePage->is_active]);

        return response()->json([
            'success' => true,
            'message' => 'Status template sambutan berhasil diubah!',
            'is_active' => $templatePage->is_active
        ]);
    }
}
