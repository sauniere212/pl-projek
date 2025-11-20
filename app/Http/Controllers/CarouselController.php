<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    public function index()
    {
        $carousels = Carousel::orderBy('urutan')->get();
        return view('admin.carousel.index', compact('carousels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $path = $gambar->store('carousel', 'public');
            $data['gambar'] = $path;
        }

        $lastUrutan = Carousel::max('urutan') ?? 0;
        $data['urutan'] = $lastUrutan + 1;
        $data['status'] = $data['status'] ?? 'Aktif';

        Carousel::create($data);

        return redirect()->back()
            ->with('success', 'Carousel berhasil ditambahkan')
            ->with('redirect_tab', 'carousel');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $carousel = Carousel::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $path = $gambar->store('carousel', 'public');
            $data['gambar'] = $path;
        }

        $carousel->update($data);

        return redirect()->back()
            ->with('success', 'Carousel berhasil diupdate')
            ->with('redirect_tab', 'carousel');
    }

    public function destroy($id)
    {
        $carousel = Carousel::findOrFail($id);
        $carousel->delete();

        return redirect()->back()
            ->with('success', 'Carousel berhasil dihapus!')
            ->with('redirect_tab', 'carousel');
    }
}
{}
