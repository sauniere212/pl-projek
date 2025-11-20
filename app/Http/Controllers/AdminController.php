<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\ActivityLog;
use App\Models\Berita;
use App\Models\GaleriFoto;
use App\Models\Carousel;
use App\Models\Dokumen;
use App\Models\Sambutan;
use App\Models\Profile;
use App\Models\Navbar;
use App\Models\Video;
use App\Models\VideoGaleri;
use App\Models\Calendar;
use App\Models\Agenda;
use App\Models\Banner;
use App\Models\Struktur;
use App\Models\TemplatePage;

class AdminController extends Controller
{
    public function __construct()
    {
        // Middleware auth akan diterapkan di routes
    }

    public function dashboard()
    {
        $data = [
            'totalBerita' => Berita::count(),
            'totalGaleri' => GaleriFoto::count(),
            'totalCarousel' => Carousel::count(),
            'totalDokumen' => Dokumen::count(),
            'beritas' => Berita::latest()->get(),
            'galeris' => GaleriFoto::latest()->get(),
            'videos' => Video::latest()->get(),
            'carousels' => Carousel::latest()->get(),
            'navbars' => Navbar::with('templatePage')->latest()->get(),
            'dokumens' => Dokumen::latest()->get(),
            'sambutan' => Sambutan::first(),
            'profile' => Profile::first(),
            // Data baru untuk Calendar, Agenda, Banner
            'calendars' => Calendar::latest()->get(),
            'agendas' => Agenda::latest()->get(),
            'banners' => Banner::latest()->get(),
            'strukturs' => Struktur::latest()->get(),
            'activities' => ActivityLog::latest()->with('user')->limit(10)->get(),
        ];

        return view('admin.dashboard', $data);
    }

    // Berita Management
    public function storeBerita(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambarName = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->storeAs('berita', $gambarName, 'public');
            $data['gambar'] = 'berita/' . $gambarName;
        }

        Berita::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil ditambahkan!'
        ]);
    }

    public function updateBerita(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $berita = Berita::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambarName = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->storeAs('berita', $gambarName, 'public');
            $data['gambar'] = 'berita/' . $gambarName;
        }

        $berita->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil diupdate!'
        ]);
    }

    public function destroyBerita($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();

        return redirect()->back()->with('success', 'Berita berhasil dihapus!')->with('redirect_tab', 'berita');
    }

    // Galeri Management
    public function storeGaleri(Request $request)
    {
        $request->validate([
            'judul_album' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();


        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = time() . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('galeri', $fotoName, 'public');
            $data['foto'] = 'galeri/' . $fotoName;
        }

        GaleriFoto::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Foto galeri berhasil diupload!'
        ]);
    }

    public function editGaleri($id)
    {
        $galeri = GaleriFoto::findOrFail($id);
        return response()->json([
            'success' => true,
            'galeri' => $galeri
        ]);
    }

    public function editBerita($id)
    {
        $berita = Berita::findOrFail($id);
        return response()->json([
            'success' => true,
            'berita' => $berita
        ]);
    }

    public function editCarousel($id)
    {
        $carousel = Carousel::findOrFail($id);
        return response()->json([
            'success' => true,
            'carousel' => $carousel
        ]);
    }

    public function editNavbar($id)
    {
        $navbar = Navbar::findOrFail($id);
        return response()->json([
            'success' => true,
            'navbar' => $navbar
        ]);
    }

    public function editSambutan($id)
    {
        $sambutan = Sambutan::findOrFail($id);
        return response()->json([
            'success' => true,
            'sambutan' => $sambutan
        ]);
    }

    public function editVideo($id)
    {
        $video = Video::findOrFail($id);
        return response()->json([
            'success' => true,
            'video' => $video
        ]);
    }

    public function updateGaleri(Request $request, $id)
    {
        $request->validate([
            'judul_album' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $galeri = GaleriFoto::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = time() . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('galeri', $fotoName, 'public');
            $data['foto'] = 'galeri/' . $fotoName;
        }

        $galeri->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Foto galeri berhasil diupdate!'
        ]);
    }

    public function destroyGaleri($id)
    {
        $galeri = GaleriFoto::findOrFail($id);
        $galeri->delete();

        return redirect()->back()->with('success', 'Foto galeri berhasil dihapus!')->with('redirect_tab', 'galeri');
    }

    // Video Management
    public function storeVideo(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'link_youtube' => 'required|url',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date'
        ]);

        $data = $request->all();

        // Extract YouTube video ID
        $videoId = $this->extractYouTubeId($request->link_youtube);
        if (!$videoId) {
            return response()->json([
                'success' => false,
                'message' => 'Link YouTube tidak valid!'
            ], 400);
        }

        $data['video_id'] = $videoId;
        $data['url'] = $request->link_youtube;

        Video::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Video berhasil diupload!'
        ]);
    }

    public function updateVideo(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'link_youtube' => 'required|url',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date'
        ]);

        $video = Video::findOrFail($id);
        $data = $request->all();

        // Extract YouTube video ID
        $videoId = $this->extractYouTubeId($request->link_youtube);
        if (!$videoId) {
            return response()->json([
                'success' => false,
                'message' => 'Link YouTube tidak valid!'
            ], 400);
        }

        $data['video_id'] = $videoId;
        $data['url'] = $request->link_youtube;

        $video->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Video berhasil diupdate!'
        ]);
    }

    public function destroyVideo($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();

        return redirect()->back()->with('success', 'Video berhasil dihapus!')->with('redirect_tab', 'video');
    }

    // Carousel Management
    public function storeCarousel(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'urutan' => 'required|integer|min:1|max:10'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambarName = time() . '_' . $gambar->getClientOriginalName();
            $gambar->storeAs('carousel', $gambarName , 'public');
            $data['gambar'] = 'carousel/' . $gambarName;
        }

        $data['status'] = 'Aktif';
        $data['judul'] = 'Carousel ' . $data['urutan'];
        $data['deskripsi'] = 'Deskripsi carousel ' . $data['urutan'];

        Carousel::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Gambar carousel berhasil ditambahkan!'
        ]);
    }

    public function updateCarousel(Request $request, $id)
    {
        $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'urutan' => 'required|integer|min:1|max:10'
        ]);

        $carousel = Carousel::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambarName = time() . '_' . $gambar->getClientOriginalName();
            $gambar->storeAs('carousel', $gambarName, 'public');
            $data['gambar'] = 'carousel/' . $gambarName;
        }

        // Set default values for judul and deskripsi if not provided
        if (!isset($data['judul'])) {
            $data['judul'] = 'Carousel ' . $data['urutan'];
        }
        if (!isset($data['deskripsi'])) {
            $data['deskripsi'] = 'Deskripsi carousel ' . $data['urutan'];
        }

        $carousel->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Gambar carousel berhasil diupdate!'
        ]);
    }

    public function destroyCarousel($id)
    {
        $carousel = Carousel::findOrFail($id);
        $carousel->delete();

        return redirect()->back()->with('success', 'Gambar carousel berhasil dihapus!')->with('redirect_tab', 'carousel');
    }

    // Navbar Management
    public function storeNavbar(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'urutan' => 'required|integer|min:1|max:10',
            'sub_menu' => 'nullable|array'
        ]);

        $data = $request->all();
        
        // Set is_dropdown to true if sub_menu exists and is not empty
        if ($request->has('sub_menu') && !empty($request->sub_menu)) {
            $data['is_dropdown'] = true;
        } else {
            $data['is_dropdown'] = false;
            $data['sub_menu'] = null;
        }

        $navbar = Navbar::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Menu navbar berhasil ditambahkan!',
            'navbar' => $navbar
        ]);
    }

    public function updateNavbar(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'urutan' => 'required|integer|min:1|max:10',
            'sub_menu' => 'nullable|array'
        ]);

        $navbar = Navbar::findOrFail($id);
        $data = $request->all();
        
        // Set is_dropdown to true if sub_menu exists and is not empty
        if ($request->has('sub_menu') && !empty($request->sub_menu)) {
            $data['is_dropdown'] = true;
        } else {
            $data['is_dropdown'] = false;
            $data['sub_menu'] = null;
        }

        $navbar->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Menu navbar berhasil diupdate!'
        ]);
    }

    public function destroyNavbar($id)
    {
        $navbar = Navbar::findOrFail($id);
        $navbar->delete();

        return redirect()->back()->with('success', 'Menu navbar berhasil dihapus!')->with('redirect_tab', 'navbar');
    }

    // Dokumen Management
    public function storeDokumen(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'required|string',
            'kategori' => 'required|string|max:100',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240'
        ]);

        // Petakan field form ke kolom tabel yang benar
        $payload = [
            'judul' => $request->input('nama'),
            'deskripsi' => $request->input('keterangan'),
            'kategori' => $request->input('kategori'),
        ];

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('dokumen', $fileName, 'public');
            $payload['file_path'] = 'dokumen/' . $fileName;
        }

        Dokumen::create($payload);

        return response()->json([
            'success' => true,
            'message' => 'Dokumen berhasil diupload!'
        ]);
    }

    public function updateDokumen(Request $request, $id)
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
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('dokumen', $fileName, 'public');
            $payload['file_path'] = 'dokumen/' . $fileName;
        }

        $dokumen->update($payload);

        return response()->json([
            'success' => true,
            'message' => 'Dokumen berhasil diupdate!'
        ]);
    }

    public function destroyDokumen($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $dokumen->delete();

        return redirect()->back()->with('success', 'Dokumen berhasil dihapus!')->with('redirect_tab', 'dokumen');
    }

    // Sambutan Management
    public function storeSambutan(Request $request)
    {
        $request->validate([
            'isi_sambutan' => 'required|string',
            'nama_pejabat' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto_pejabat' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'isi_sambutan' => $request->isi_sambutan,
            'nama_pejabat' => $request->nama_pejabat,
            'jabatan' => $request->jabatan,
        ];

        if ($request->hasFile('foto_pejabat')) {
            $foto = $request->file('foto_pejabat');
            $fotoName = time() . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('sambutan', $fotoName, 'public');
            $data['foto_pejabat'] = 'sambutan/' . $fotoName;
        }

        $sambutan = Sambutan::first();

        if ($sambutan) {
            $sambutan->update($data);
        } else {
            Sambutan::create($data);
        }

        return redirect()->back()->with('success', 'Sambutan berhasil disimpan!')->with('redirect_tab', 'profile');
    }

    public function updateSambutan(Request $request, $id)
    {
        $request->validate([
            'isi_sambutan' => 'required|string',
            'nama_pejabat' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto_pejabat' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $sambutan = Sambutan::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('foto_pejabat')) {
            $foto = $request->file('foto_pejabat');
            $fotoName = time() . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('sambutan', $fotoName, 'public');
            $data['foto_pejabat'] = 'sambutan/' . $fotoName;
        }

        $sambutan->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Sambutan berhasil diupdate!'
        ]);
    }

    // Profile Management
    public function storeProfile(Request $request)
    {
        $request->validate([
            'nama_instansi' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'website' => 'nullable|url|max:255',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = time() . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('profile', $fotoName, 'public');
            $data['foto'] = 'profile/' . $fotoName;
        }

        $profile = Profile::first();

        if ($profile) {
            $profile->update($data);
        } else {
            Profile::create($data);
        }

        return response()->json([
            'success' => true,
            'message' => 'Profile berhasil disimpan!'
        ]);
    }

    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'nama_instansi' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'website' => 'nullable|url|max:255',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $profile = Profile::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = time() . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('profile', $fotoName, 'public');
            $data['foto'] = 'profile/' . $fotoName;
        }

        $profile->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Profile berhasil diupdate!'
        ]);
    }

    // Calendar Management
    public function storeCalendar(Request $request)
    {
        $request->validate([
            'hari' => 'required|string|max:20',
            'tanggal' => 'required|date',
            'kegiatan' => 'required|string'
        ]);

        Calendar::create($request->all());

        return redirect()->back()->with('success', 'Kegiatan calendar berhasil ditambahkan!')->with('redirect_tab', 'calendar');
    }

    public function updateCalendar(Request $request, $id)
    {
        $request->validate([
            'hari' => 'required|string|max:20',
            'tanggal' => 'required|date',
            'kegiatan' => 'required|string'
        ]);

        $calendar = Calendar::findOrFail($id);
        $calendar->update($request->all());

        return redirect()->back()->with('success', 'Kegiatan calendar berhasil diupdate!')->with('redirect_tab', 'calendar');
    }

    public function destroyCalendar($id)
    {
        $calendar = Calendar::findOrFail($id);
        $calendar->delete();

        return redirect()->back()->with('success', 'Kegiatan calendar berhasil dihapus!')->with('redirect_tab', 'calendar');
    }

    public function editCalendar($id)
    {
        $calendar = Calendar::findOrFail($id);
        return response()->json([
            'success' => true,
            'calendar' => $calendar
        ]);
    }

    // Agenda Management
    public function storeAgenda(Request $request)
    {
        $request->validate([
            'kegiatan' => 'required|string|max:255',
            'tempat' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu' => 'required'
        ]);

        Agenda::create($request->all());

        return redirect()->back()->with('success', 'Agenda berhasil ditambahkan!')->with('redirect_tab', 'agenda');
    }

    public function updateAgenda(Request $request, $id)
    {
        $request->validate([
            'kegiatan' => 'required|string|max:255',
            'tempat' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu' => 'required'
        ]);

        $agenda = Agenda::findOrFail($id);
        $agenda->update($request->all());

        return redirect()->back()->with('success', 'Agenda berhasil diupdate!')->with('redirect_tab', 'agenda');
    }

    public function destroyAgenda($id)
    {
        $agenda = Agenda::findOrFail($id);
        $agenda->delete();

        return redirect()->back()->with('success', 'Agenda berhasil dihapus!')->with('redirect_tab', 'agenda');
    }

    public function editAgenda($id)
    {
        $agenda = Agenda::findOrFail($id);
        return response()->json([
            'success' => true,
            'agenda' => $agenda
        ]);
    }

    // Banner Management
    public function storeBanner(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'urutan' => 'required|integer|min:1|max:10'
        ]);

        $data = [
            'urutan' => $request->urutan,
            'judul' => 'Banner ' . $request->urutan,
            'deskripsi' => 'Banner urutan ' . $request->urutan,
        ];

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambarName = time() . '_' . $gambar->getClientOriginalName();
            $gambar->storeAs('banner', $gambarName, 'public');
            $data['gambar'] = 'banner/' . $gambarName;
        }

        Banner::create($data);

        return redirect()->back()->with('success', 'Banner berhasil ditambahkan!')->with('redirect_tab', 'banner');
    }

    public function updateBanner(Request $request, $id)
    {
        $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'urutan' => 'required|integer|min:1|max:10'
        ]);

        $banner = Banner::findOrFail($id);
        $data = [
            'urutan' => $request->urutan,
            'judul' => 'Banner ' . $request->urutan,
            'deskripsi' => 'Banner urutan ' . $request->urutan,
        ];

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambarName = time() . '_' . $gambar->getClientOriginalName();
            $gambar->storeAs('banner', $gambarName, 'public');
            $data['gambar'] = 'banner/' . $gambarName;
        }

        $banner->update($data);

        return redirect()->back()->with('success', 'Banner berhasil diupdate!')->with('redirect_tab', 'banner');
    }

    public function destroyBanner($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();

        return redirect()->back()->with('success', 'Banner berhasil dihapus!')->with('redirect_tab', 'banner');
    }

    public function editBanner($id)
    {
        $banner = Banner::findOrFail($id);
        return response()->json([
            'success' => true,
            'banner' => $banner
        ]);
    }

    // Visi Misi Management
    public function storeVisiMisi(Request $request)
    {
        $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|string',
            'tujuan_strategis' => 'nullable|string'
        ]);

        // Hapus data lama jika ada
        \App\Models\VisiMisi::truncate();

        \App\Models\VisiMisi::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Visi Misi berhasil disimpan!'
        ]);
    }

    public function getVisiMisi()
    {
        $visiMisi = \App\Models\VisiMisi::first();
        return response()->json([
            'success' => true,
            'visiMisi' => $visiMisi
        ]);
    }

    // Pejabat Management
    public function storePejabat(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'urutan' => 'required|integer|min:1'
        ]);

        $data = $request->except('foto');
        
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/pejabat'), $filename);
            $data['foto'] = 'pejabat/' . $filename;
        }

        \App\Models\Pejabat::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Data pejabat berhasil disimpan!'
        ]);
    }

    public function getPejabats()
    {
        $pejabats = \App\Models\Pejabat::orderBy('urutan')->get();
        return response()->json([
            'success' => true,
            'pejabats' => $pejabats
        ]);
    }

    public function editPejabat($id)
    {
        $pejabat = \App\Models\Pejabat::findOrFail($id);
        return response()->json([
            'success' => true,
            'pejabat' => $pejabat
        ]);
    }

    public function updatePejabat(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'urutan' => 'required|integer|min:1'
        ]);

        $pejabat = \App\Models\Pejabat::findOrFail($id);
        $data = $request->except('foto');
        
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($pejabat->foto && file_exists(public_path('storage/' . $pejabat->foto))) {
                unlink(public_path('storage/' . $pejabat->foto));
            }
            
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/pejabat'), $filename);
            $data['foto'] = 'pejabat/' . $filename;
        }

        $pejabat->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Data pejabat berhasil diupdate!'
        ]);
    }

    public function destroyPejabat($id)
    {
        $pejabat = \App\Models\Pejabat::findOrFail($id);
        
        // Hapus foto jika ada
        if ($pejabat->foto && file_exists(public_path('storage/' . $pejabat->foto))) {
            unlink(public_path('storage/' . $pejabat->foto));
        }
        
        $pejabat->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data pejabat berhasil dihapus!'
        ]);
    }

    // Struktur Management
    public function storeStruktur(Request $request)
    {
        $request->validate([
            'struktur_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('struktur_image')) {
            $gambar = $request->file('struktur_image');
            $gambarName = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->storeAs('struktur', $gambarName, 'public');
            
            \App\Models\Struktur::create([
                'gambar' => 'struktur/' . $gambarName
            ]);

            return redirect()->route('admin.dashboard')->with('success', 'Struktur organisasi berhasil ditambahkan!')->with('redirect_tab', 'struktur');
        }

        return redirect()->back()->with('error', 'Terjadi kesalahan saat upload file.');
    }

    public function editStruktur($id)
    {
        $struktur = \App\Models\Struktur::findOrFail($id);
        return response()->json([
            'success' => true,
            'struktur' => $struktur
        ]);
    }

    public function updateStruktur(Request $request, $id)
    {
        $request->validate([
            'struktur_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $struktur = \App\Models\Struktur::findOrFail($id);

        if ($request->hasFile('struktur_image')) {
            // Hapus file lama jika ada
            if ($struktur->gambar && file_exists(public_path('storage/' . $struktur->gambar))) {
                unlink(public_path('storage/' . $struktur->gambar));
            }

            $gambar = $request->file('struktur_image');
            $gambarName = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->storeAs('struktur', $gambarName, 'public');

            $struktur->update([
                'gambar' => 'struktur/' . $gambarName
            ]);

            return redirect()->route('admin.dashboard')->with('success', 'Struktur organisasi berhasil diperbarui!')->with('redirect_tab', 'struktur');
        }

        return redirect()->back()->with('error', 'Terjadi kesalahan saat update file.');
    }

    public function destroyStruktur($id)
    {
        $struktur = \App\Models\Struktur::findOrFail($id);

        // Hapus file jika ada
        if ($struktur->gambar && file_exists(public_path('storage/' . $struktur->gambar))) {
            unlink(public_path('storage/' . $struktur->gambar));
        }
        
        $struktur->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Struktur organisasi berhasil dihapus!')->with('redirect_tab', 'struktur');
    }

    // Helper function to extract YouTube video ID
    private function extractYouTubeId($url)
    {
        $regExp = '/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/';
        $match = preg_match($regExp, $url, $matches);
        return ($match && strlen($matches[2]) === 11) ? $matches[2] : null;
    }

    // Template Page Management
    public function storeTemplatePage(Request $request)
    {
        Log::info('Template store request received', $request->all());
        
        // Validasi berdasarkan template type
        $validationRules = [
            'template_type' => 'required|in:berita,sambutan',
            'judul_halaman' => 'required|string|max:255',
            'isi_content' => 'required|string',
            'tanggal' => 'required|date',
            'navbar_id' => 'required|exists:navbars,id'
        ];

        if ($request->template_type === 'berita') {
            $validationRules['judul_content'] = 'required|string|max:255';
            $validationRules['kategori'] = 'nullable|string|max:100';
            $validationRules['penulis'] = 'nullable|string|max:100';
        } elseif ($request->template_type === 'sambutan') {
            $validationRules['nama_pejabat'] = 'required|string|max:255';
            $validationRules['jabatan'] = 'required|string|max:255';
        }

        try {
            $request->validate($validationRules);
            Log::info('Validation passed');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed', $e->errors());
            throw $e;
        }

        $data = $request->all();
        Log::info('Data prepared', $data);
        
        // Set default values untuk field yang tidak ada
        if ($request->template_type === 'berita') {
            $data['judul_content'] = $data['judul_content'] ?? '';
            $data['kategori'] = $data['kategori'] ?? null;
            $data['penulis'] = $data['penulis'] ?? null;
            $data['gambar'] = null;
            $data['nama_pejabat'] = null;
            $data['jabatan'] = null;
            $data['foto_pejabat'] = null;
        } elseif ($request->template_type === 'sambutan') {
            $data['judul_content'] = $data['judul_halaman']; // Untuk sambutan, gunakan judul_halaman sebagai judul_content
            $data['kategori'] = null;
            $data['penulis'] = null;
            $data['gambar'] = null;
            $data['nama_pejabat'] = $data['nama_pejabat'] ?? '';
            $data['jabatan'] = $data['jabatan'] ?? '';
            $data['foto_pejabat'] = null;
        }
        
        // No file uploads needed for both berita and sambutan templates

        // Generate slug
        $data['slug'] = \Illuminate\Support\Str::slug($data['judul_halaman']);

        try {
            // Create template page
            Log::info('Creating template page with data', $data);
            $templatePage = TemplatePage::create($data);
            Log::info('Template page created successfully', ['id' => $templatePage->id]);

            // Update navbar with template_page_id
            $navbar = Navbar::find($request->navbar_id);
            Log::info('Navbar found', ['id' => $navbar->id]);
            if (!$navbar) {
                return response()->json([
                    'success' => false,
                    'message' => 'Navbar tidak ditemukan!'
                ], 404);
            }
            
            $navbar->update(['template_page_id' => $templatePage->id]);

            return redirect()->back()->with('success', 'Template berhasil disimpan!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error saving template: ' . $e->getMessage());
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', 'Validasi gagal: ' . implode(', ', collect($e->errors())->flatten()->toArray()));
        } catch (\Exception $e) {
            Log::error('Error saving template: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan template: ' . $e->getMessage());
        }
    }
}
