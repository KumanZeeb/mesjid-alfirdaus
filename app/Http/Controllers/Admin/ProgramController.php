<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Menampilkan daftar program.
     */
    public function index()
    {
        $programs = Program::all();
        return view('admin.programs.index', compact('programs'));
    }

    /**
     * Menampilkan form untuk membuat program baru.
     */
    public function create()
    {
        return view('admin.programs.create');
    }

    /**
     * Menyimpan program baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'schedule' => 'required|string|max:255',
            'icon_class' => 'nullable|string|max:255',
            'has_form' => 'required|boolean', 
        ]);

        Program::create([
            'name' => $request->name,
            'schedule' => $request->schedule,
            'icon_class' => $request->icon_class,
            'has_form' => $request->has_form, // Simpan nilai has_form
        ]);

        return redirect()->route('admin.programs.index')->with('success', 'Program berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail program.
     */
    public function show(Program $program)
    {
        return view('admin.programs.show', compact('program'));
    }

    /**
     * Menampilkan form untuk mengedit program.
     */
    public function edit(Program $program)
    {
        return view('admin.programs.edit', compact('program'));
    }

    /**
     * Mengupdate program di database.
     */
    public function update(Request $request, Program $program)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'schedule' => 'required|string|max:255',
            'icon_class' => 'nullable|string|max:255',
            'has_form' => 'required|boolean', // Validasi untuk has_form
        ]);

        $program->update([
            'name' => $request->name,
            'schedule' => $request->schedule,
            'icon_class' => $request->icon_class,
            'has_form' => $request->has_form, // Update nilai has_form
        ]);

        return redirect()->route('admin.programs.index')->with('success', 'Program berhasil diupdate!');
    }

    /**
     * Menghapus program dari database.
     */
    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('admin.programs.index')->with('success', 'Program berhasil dihapus!');
    }
}