@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Edit Galeri</h1>
    
    <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
            <input type="text" name="title" id="title" value="{{ $gallery->title }}" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Gambar Saat Ini</label>
            <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" 
                 class="mt-2 h-32 w-auto rounded-md shadow">
        </div>
        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Gambar Baru (Opsional)</label>
            <input type="file" name="image" id="image" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea name="description" id="description" rows="3" 
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ $gallery->description }}</textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Galeri</button>
    </form>
</div>
@endsection