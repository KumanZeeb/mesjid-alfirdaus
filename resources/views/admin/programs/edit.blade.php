<!-- resources/views/admin/programs/edit.blade.php -->

@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Edit Program</h1>
    <form action="{{ route('admin.programs.update', $program->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nama Program -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nama Program</label>
            <input type="text" name="name" id="name" value="{{ $program->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        </div>

        <!-- Jadwal -->
        <div class="mb-4">
            <label for="schedule" class="block text-sm font-medium text-gray-700">Jadwal</label>
            <input type="text" name="schedule" id="schedule" value="{{ $program->schedule }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        </div>

        <!-- Icon Class -->
        <div class="mb-4">
            <label for="icon_class" class="block text-sm font-medium text-gray-700">Kelas Icon (Contoh: fas fa-book)</label>
            <input type="text" name="icon_class" id="icon_class" value="{{ $program->icon_class }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>

        <!-- Apakah Program Ini Memiliki Form? -->
        <div class="mb-4">
            <label for="has_form" class="block text-sm font-medium text-gray-700">Apakah Program Ini Memiliki Form?</label>
            <select name="has_form" id="has_form" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <option value="0" {{ $program->has_form == 0 ? 'selected' : '' }}>Tidak</option>
                <option value="1" {{ $program->has_form == 1 ? 'selected' : '' }}>Ya</option>
            </select>
        </div>

        <!-- Tombol Submit -->
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
    </form>
</div>
@endsection