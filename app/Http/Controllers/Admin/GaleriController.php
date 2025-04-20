<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Untuk generate nama file unik
use Illuminate\Support\Facades\Storage; // Untuk handle file upload

class GaleriController extends Controller
{
    // Menampilkan semua data galeri
    public function index()
    {
        $galleries = Galeri::all();
        return view('admin.galleries.index', compact('galleries'));
    }

    // Menampilkan form create
    public function create()
    {
        return view('admin.galleries.create');
    }

    // Menyimpan data galeri baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Maksimal 2MB
            'description' => 'nullable|string',
        ]);

        // Handle upload gambar
        if ($request->hasFile('image')) {
            $file = $request->file('image'); // Ambil file
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension(); // Generate nama unik
            $path = $file->storeAs('galleries', $filename, 'public'); // Simpan ke folder public/galleries
        }

        // Simpan data ke database
        Galeri::create([
            'title' => $request->title,
            'image' => $path, // Path gambar yang disimpan
            'description' => $request->description,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil ditambahkan!');
    }

    // Menampilkan detail galeri
    public function show(Galeri $gallery)
    {
        return view('admin.galleries.show', compact('gallery'));
    }

    // Menampilkan form edit
    public function edit(Galeri $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    // Update data galeri
    public function update(Request $request, Galeri $gallery)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Maksimal 2MB
            'description' => 'nullable|string',
        ]);

        // Ambil data input kecuali gambar
        $data = $request->except('image');

        // Handle update gambar jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                Storage::disk('public')->delete($gallery->image);
            }

            // Upload gambar baru
            $file = $request->file('image');
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $data['image'] = $file->storeAs('galleries', $filename, 'public');
        }

        // Update data galeri
        $gallery->update($data);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil diupdate!');
    }

    // Hapus data galeri
    public function destroy(Galeri $gallery)
    {
        // Hapus gambar dari storage jika ada
        if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
            Storage::disk('public')->delete($gallery->image);
        }

        // Hapus data dari database
        $gallery->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil dihapus!');
    }
}