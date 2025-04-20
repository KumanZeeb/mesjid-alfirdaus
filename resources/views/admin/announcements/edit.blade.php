@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Edit Pengumuman</h1>
    
    <form action="{{ route('admin.announcements.update', $announcement->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
            <input type="text" name="title" id="title" value="{{ $announcement->title }}" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        </div>
        <div class="mb-4">
            <label for="detail" class="block text-sm font-medium text-gray-700">Detail</label>
            <textarea name="detail" id="detail" rows="4" 
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>{{ $announcement->detail }}</textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Pengumuman</button>
    </form>
</div>
@endsection