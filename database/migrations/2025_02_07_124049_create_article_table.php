<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        // Jika kamu ingin memastikan tabel lama dihapus terlebih dahulu, kamu bisa menguncomment baris di bawah ini.
        // Schema::dropIfExists('articles');

        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');               // Judul artikel
            $table->string('category');            // Kategori artikel
            $table->text('content');               // Konten artikel (bisa HTML)
            $table->string('image');               // Nama kolom untuk menyimpan gambar (sebelumnya 'thumbnail')
            $table->string('meta_title')->nullable();      // Meta title, opsional
            $table->text('meta_description')->nullable();  // Meta description, opsional
            $table->timestamps();                  // created_at dan updated_at
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
