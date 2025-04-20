<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItikafForm extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan
    protected $table = 'itikaf_forms';

    // Kolom yang bisa diisi (fillable)
    protected $fillable = [
        'program_id',
        'nama_lengkap',
        'umur',
        'alamat',
        'tanggal_masuk',
        'tanggal_keluar',
    ];

    // Relasi ke tabel programs
    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }
}
