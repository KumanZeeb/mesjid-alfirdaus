@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Daftar Pengumuman</h1>
    <a href="{{ route('admin.announcements.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Pengumuman</a>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Judul</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Detail</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($announcements as $announcement)
                <tr class="border-b">
                    <td class="px-6 py-4">{{ $announcement->title }}</td>
                    <td class="px-6 py-4">{{ Str::limit($announcement->detail, 50) }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.announcements.edit', $announcement->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                        <form action="{{ route('admin.announcements.destroy', $announcement->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 ml-2">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection