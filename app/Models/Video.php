<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'ustadz',
        'date',
        'embed_id',
        'category'
    ];

    // Tambahkan casting untuk kolom 'date'
    protected $casts = [
        'date' => 'date', // atau 'datetime' jika kolomnya tipe datetime
    ];
}