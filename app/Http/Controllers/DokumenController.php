<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Carousel;
use App\Models\Navbar;
use Illuminate\Http\Request;

class DokumenController extends Controller
{
    public function index()
    {
        $dokumens = Dokumen::orderBy('created_at', 'desc')->get();
        $carousels = Carousel::where('status', 'Aktif')->orderBy('urutan')->get();
        $navbars = Navbar::with('templatePage')->orderBy('urutan')->get();

        return view('dokumen', compact('dokumens', 'carousels', 'navbars'));
    }

    public function adminIndex()
    {
        $dokumens = Dokumen::orderBy('created_at', 'desc')->get();
        return view('admin.dokumen.index', compact('dokumens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'required|string',
            'kategori' => 'required|string|max:100',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240'
        ]);

        $payload = [
            'judul' => $request->input('nama'),
            'deskripsi' => $request->input('keterangan'),
            'kategori' => $request->input('kategori'),
        ];

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('dokumen', 'public');
            $payload['file_path'] = $path;
        }

        Dokumen::create($payload);

        return redirect()->back()->with('success', 'Dokumen berhasil disimpan!')->with('redirect_tab', 'dokumen');
    }

    public function edit($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        return response()->json([
            'success' => true,
            'dokumen' => $dokumen
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'required|string',
            'kategori' => 'required|string|max:100',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240'
        ]);

        $dokumen = Dokumen::findOrFail($id);

        $payload = [
            'judul' => $request->input('nama'),
            'deskripsi' => $request->input('keterangan'),
            'kategori' => $request->input('kategori'),
        ];

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('dokumen', 'public');
            $payload['file_path'] = $path;
        }

        $dokumen->update($payload);

        return response()->json([
            'success' => true,
            'message' => 'Dokumen berhasil diupdate!'
        ]);
    }

    public function destroy($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $dokumen->delete();
        return redirect()->back()->with('success', 'Dokumen berhasil dihapus!')->with('redirect_tab', 'dokumen');
    }
}
