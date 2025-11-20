<?php

namespace App\Http\Controllers;

use App\Models\Sambutan;
use App\Models\Carousel;
use App\Models\Navbar;
use Illuminate\Http\Request;

class SambutanController extends Controller
{
    public function index()
    {
        $sambutan = Sambutan::latest()->first();
        $carousels = Carousel::where('status', 'Aktif')->orderBy('urutan')->get();
        $navbars = Navbar::with('templatePage')->orderBy('urutan')->get();
        
        return view('sambutan', compact('sambutan', 'carousels', 'navbars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'isi_sambutan' => 'required|string',
            'nama_pejabat' => 'required|string',
            'jabatan' => 'required|string',
            'foto_pejabat' => 'nullable|string'
        ]);

        Sambutan::create($request->all());

        return response()->json(['success' => true, 'message' => 'Sambutan berhasil disimpan']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'isi_sambutan' => 'required|string',
            'nama_pejabat' => 'required|string',
            'jabatan' => 'required|string',
            'foto_pejabat' => 'nullable|string'
        ]);

        $sambutan = Sambutan::findOrFail($id);
        $sambutan->update($request->all());

        return response()->json(['success' => true, 'message' => 'Sambutan berhasil diupdate']);
    }
}
