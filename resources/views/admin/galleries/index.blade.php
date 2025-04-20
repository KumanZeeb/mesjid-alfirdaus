@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Daftar Galeri</h1>
    <a href="{{ route('admin.galleries.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Galeri</a>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($galleries as $gallery)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" class="w-full h-48 object-cover">
            <div class="p-4">
                <h3 class="font-semibold">{{ $gallery->title }}</h3>
                <p class="text-gray-600 text-sm mt-2">{{ $gallery->description }}</p>
                <div class="mt-4">
                    <a href="{{ route('admin.galleries.edit', $gallery->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                    <form action="{{ route('admin.galleries.destroy', $gallery->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 ml-2">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection