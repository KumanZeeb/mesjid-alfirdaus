<?php
namespace App\Http\Controllers;

use App\Models\ItikafForm;
use App\Models\Program;
use Illuminate\Http\Request;

class ItikafFormController extends Controller
{
    // Menampilkan form Itikaf (tidak perlu view karena sudah di modal)
    public function create($programId)
    {
        // Cek apakah program memiliki form
        $program = Program::findOrFail($programId);
        if (!$program->has_form) {
            return redirect()->back()->with('error', 'Program ini tidak memiliki form.');
        }
    }

    // Menyimpan data Itikaf
    public function store(Request $request, $programId)
    {
        // Validasi input
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'umur' => 'required|integer|min:1',
            'alamat' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'tanggal_keluar' => 'required|date|after_or_equal:tanggal_masuk',
        ]);

        // Simpan data ke database
        ItikafForm::create([
            'program_id' => $programId,
            'nama_lengkap' => $request->nama_lengkap,
            'umur' => $request->umur,
            'alamat' => $request->alamat,
            'tanggal_masuk' => $request->tanggal_masuk,
            'tanggal_keluar' => $request->tanggal_keluar,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Form Itikaf berhasil disubmit!');
    }
}