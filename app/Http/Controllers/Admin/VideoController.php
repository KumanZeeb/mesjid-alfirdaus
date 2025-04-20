<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::all();
        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.videos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'ustadz' => 'required',
            'date' => 'required|date',
            'embed_id' => 'required',
            'category' => 'required',
        ]);

        Video::create($request->all());
        return redirect()->route('admin.videos.index')->with('success', 'Video berhasil ditambahkan!');
    }

    public function show(Video $video)
    {
        return view('admin.videos.show', compact('video'));
    }

    public function edit(Video $video)
    {
        return view('admin.videos.edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title' => 'required',
            'ustadz' => 'required',
            'date' => 'required|date',
            'embed_id' => 'required',
            'category' => 'required',
        ]);

        $video->update($request->all());
        return redirect()->route('admin.videos.index')->with('success', 'Video berhasil diupdate!');
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('admin.videos.index')->with('success', 'Video berhasil dihapus!');
    }
}