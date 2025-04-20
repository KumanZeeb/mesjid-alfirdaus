@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Edit Artikel</h1>

    <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
            <input type="text" name="title" id="title" value="{{ $article->title }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        </div>
        <div class="mb-4">
            <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
            <input type="text" name="category" id="category" value="{{ $article->category }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        </div>
        <!-- resources/views/admin/articles/create.blade.php -->
        <div class="mb-8 bg-green-50 p-4 rounded-lg shadow-sm">
            <h3 class="text-lg font-bold text-green-800 mb-2">📝 Panduan Format</h3>
            <ul class="space-y-2 text-sm text-gray-700">
                <!-- Tebal -->
                <li>
                    <span class="font-bold">**Teks Tebal**:</span>
                    <code>**Teks**</code> → <strong>Teks</strong>
                </li>

                <!-- Heading 2 -->
                <li>
                    <span class="font-bold">## Heading 2:</span>
                    <code>## Judul</code> → <h2 class="text-2xl font-bold">Judul</h2>
                </li>

                <!-- Heading 3 -->
                <li>
                    <span class="font-bold">### Heading 3:</span>
                    <code>### Subjudul</code> → <h3 class="text-xl font-semibold">Subjudul</h3>
                </li>

                <!-- Kutipan Ayat -->
                <li>
                    <span class="font-bold">> Kutipan:</span>
                    <code>> "Ayat Arab"</code> → 
                    <blockquote class="border-l-4 border-green-500 pl-4 italic text-gray-700 bg-green-50 py-2 my-2">
                        "Ayat Arab"
                    </blockquote>
                </li>

                <!-- List Biasa -->
                <li>
                    <span class="font-bold">- List Biasa:</span>
                    <code>- Item 1</code> → 
                    <ul class="list-disc pl-8">
                        <li>Item 1</li>
                    </ul>
                </li>

                <!-- List Khusus -->
                <li>
                    <span class="font-bold">List Custom:</span>
                    <pre class="bg-gray-100 p-2 rounded text-sm">
        &lt;ul class="custom-list"&gt;
            &lt;li&gt;Item 1&lt;/li&gt;
            &lt;li&gt;Item 2&lt;/li&gt;
        &lt;/ul&gt;</pre>
                    <p class="mt-1">Hasil:</p>
                    <ul class="custom-list list-none pl-0">
                        <li class="pl-4 border-l-4 border-green-300 my-2">Item 1</li>
                        <li class="pl-4 border-l-4 border-green-300 my-2">Item 2</li>
                    </ul>
                </li>

                <!-- Gambar -->
                <li>
                    <span class="font-bold">🖼️ Gambar:</span> Upload gambar di form, otomatis ada efek hover.
                </li>
            </ul>
        </div>

        <!-- Textarea Input -->
        <div class="mb-4">
            <label for="content" class="block text-sm font-medium text-gray-700">Konten</label>
            <textarea 
                name="content" 
                id="content" 
                rows="10" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm font-mono text-sm"
                placeholder="Tulis konten di sini..."
                required>{{ old('content', $article->content ?? '') }}</textarea>
        </div>
        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Gambar</label>
            <input type="file" name="image" id="image" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @if($article->image)
            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="mt-2 h-32 w-auto rounded-md shadow">
            @endif
        </div>
        <div class="mb-4">
            <label for="meta_title" class="block text-sm font-medium text-gray-700">Meta Title</label>
            <input type="text" name="meta_title" id="meta_title" value="{{ $article->meta_title }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
        <div class="mb-4">
            <label for="meta_description" class="block text-sm font-medium text-gray-700">Meta Description</label>
            <textarea name="meta_description" id="meta_description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ $article->meta_description }}</textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Artikel</button>
    </form>
</div>
@endsection