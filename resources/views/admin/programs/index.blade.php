@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Daftar Program</h1>
    <a href="{{ route('admin.programs.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">
        Tambah Program
    </a>
    <div class="space-y-4">
        @foreach($programs as $program)
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-bold mb-4">{{ $program->name }}</h3>
            <p class="text-sm text-gray-600">{{ $program->schedule }}</p>
            <p class="text-sm text-gray-600">Icon: <i class="{{ $program->icon_class }}"></i></p>
            <p class="text-sm text-gray-600">Memiliki Form: {{ $program->has_form ? 'Ya' : 'Tidak' }}</p>

            <div class="mt-4 space-x-2">
                <a href="{{ route('admin.programs.edit', $program->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                    Edit
                </a>
                <form action="{{ route('admin.programs.destroy', $program->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection