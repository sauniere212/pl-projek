<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Pejabat;
use App\Models\Carousel;
use App\Models\Navbar;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $pejabats = Pejabat::orderBy('urutan')->get();
        $carousels = Carousel::where('status', 'Aktif')->orderBy('urutan')->get();
        $navbars = Navbar::with('templatePage')->orderBy('urutan')->get();
        
        return view('data-pejabat', compact('pejabats', 'carousels', 'navbars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'jabatan' => 'required|string',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|string',
            'email' => 'nullable|email',
            'telepon' => 'nullable|string'
        ]);

        Profile::create($request->all());

        return response()->json(['success' => true, 'message' => 'Data pejabat berhasil disimpan']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'jabatan' => 'required|string',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|string',
            'email' => 'nullable|email',
            'telepon' => 'nullable|string'
        ]);

        $profile = Profile::findOrFail($id);
        $profile->update($request->all());

        return response()->json(['success' => true, 'message' => 'Data pejabat berhasil diupdate']);
    }

    public function destroy($id)
    {
        $profile = Profile::findOrFail($id);
        $profile->delete();

        return response()->json(['success' => true, 'message' => 'Data pejabat berhasil dihapus']);
    }
}
