@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Tambah Artikel</h1>

    <!-- Tampilkan pesan error -->
    @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-700">
                        Terdapat {{ $errors->count() }} kesalahan yang harus diperbaiki.
                    </h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
            <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('title') }}" required>
        </div>
        <div class="mb-4">
            <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
            <input type="text" name="category" id="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('category') }}" required>
        </div>
        <div class="mb-8 bg-green-50 p-4 rounded-lg">
            <h3 class="text-lg font-bold text-green-800 mb-2">📝 Panduan Format</h3>
            <ul class="space-y-2 text-sm text-gray-700">
                <li>
                    <span class="font-bold">**Teks Tebal**:</span>
                    <code>**Teks**</code> → <strong>Teks</strong>
                </li>
                <li>
                    <span class="font-bold">## Heading 2:</span>
                    <code>## Judul</code> → <h2 class="text-2xl font-bold">Judul</h2>
                </li>
                <li>
                    <span class="font-bold">> Kutipan:</span>
                    <code>> "Ayat Arab"</code> → 
                    <blockquote class="border-l-4 border-green-500 pl-4 italic">
                        "Ayat Arab"
                    </blockquote>
                </li>
                <li>
                    <span class="font-bold">🖼️ Gambar:</span> Upload via form, otomatis ada efek hover.
                </li>
            </ul>
        </div>
        <div class="mb-4">
            <label for="content" class="block text-sm font-medium text-gray-700">Konten Artikel</label>
            <textarea 
                name="content" 
                id="content" 
                rows="15"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm font-mono text-sm"
                placeholder="Tulis konten di sini..."
                required>{{ old('content') }}</textarea>
        </div>
        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Gambar</label>
            <input type="file" name="image" id="image" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
        <div class="mb-4">
            <label for="meta_title" class="block text-sm font-medium text-gray-700">Meta Title</label>
            <input type="text" name="meta_title" id="meta_title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('meta_title') }}">
        </div>
        <div class="mb-4">
            <label for="meta_description" class="block text-sm font-medium text-gray-700">Meta Description</label>
            <textarea name="meta_description" id="meta_description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('meta_description') }}</textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded flex items-center justify-center">
            <span id="submit-text">Simpan Artikel</span>
            <svg id="submit-spinner" class="hidden ml-2 h-5 w-5 animate-spin text-white" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </button>
    </form>
</div>

<script>
    document.querySelector('form').addEventListener('submit', function () {
        document.getElementById('submit-text').classList.add('hidden');
        document.getElementById('submit-spinner').classList.remove('hidden');
    });
</script>
@endsection