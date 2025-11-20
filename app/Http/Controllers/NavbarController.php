<?php

namespace App\Http\Controllers;

use App\Models\Navbar;
use Illuminate\Http\Request;

class NavbarController extends Controller
{
    public function index()
    {
        $navbars = Navbar::with('templatePage')->orderBy('urutan')->get();
        return response()->json($navbars);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'is_dropdown' => 'boolean',
            'sub_menu' => 'nullable|array',
            'urutan' => 'required|integer|min:1',
            'is_active' => 'boolean'
        ]);

        $navbar = Navbar::create($request->all());
        return response()->json($navbar, 201);
    }

    public function update(Request $request, Navbar $navbar)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'is_dropdown' => 'boolean',
            'sub_menu' => 'nullable|array',
            'urutan' => 'required|integer|min:1',
            'is_active' => 'boolean'
        ]);

        $navbar->update($request->all());
        return response()->json($navbar);
    }

    public function destroy($id)
    {
        $navbar = Navbar::findOrFail($id);
        $navbar->delete();

        return redirect()->back()->with('success', 'Menu berhasil dihapus!')->with('redirect_tab', 'navbar');
    }
}
