@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Daftar Video</h1>
    <a href="{{ route('admin.videos.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Video</a>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($videos as $video)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="aspect-w-16 aspect-h-9">
                <iframe src="https://www.youtube.com/embed/{{ $video->embed_id }}" frameborder="0" allowfullscreen class="w-full h-full"></iframe>
            </div>
            <div class="p-4">
                <h3 class="font-semibold">{{ $video->title }}</h3>
                <p class="text-sm text-gray-600 mt-2">Ustadz: {{ $video->ustadz }}</p>
                <div class="mt-4">
                    <a href="{{ route('admin.videos.edit', $video->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                    <form action="{{ route('admin.videos.destroy', $video->id) }}" method="POST" class="inline">
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