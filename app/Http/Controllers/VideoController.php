<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::orderBy('tanggal', 'desc')->get();
        return response()->json($videos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'video_id' => 'required|string|max:255',
            'url' => 'required|string|max:500'
        ]);

        $video = Video::create($request->all());
        return response()->json($video, 201);
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'video_id' => 'required|string|max:255',
            'url' => 'required|string|max:500'
        ]);

        $video->update($request->all());
        return response()->json($video);
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();
        return redirect()->back()->with('success', 'Video berhasil dihapus!')->with('redirect_tab', 'video');
    }
}
