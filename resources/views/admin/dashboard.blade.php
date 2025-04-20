@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Admin Panel - Masjid Al-Firdaus</h1>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <!-- Card Artikel -->
        <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-gray-700">Total Artikel</h3>
                    <p class="text-3xl font-bold text-green-600">{{ $totalArticles }}</p>
                </div>
                <i class="fas fa-newspaper text-4xl text-green-500"></i>
            </div>
            <a href="{{ route('admin.articles.index') }}" class="mt-4 inline-block text-green-600 hover:text-green-800">
                Kelola Artikel <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>

        <!-- Card Video -->
        <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-gray-700">Total Video</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ $totalVideos }}</p>
                </div>
                <i class="fas fa-video text-4xl text-blue-500"></i>
            </div>
            <a href="{{ route('admin.videos.index') }}" class="mt-4 inline-block text-blue-600 hover:text-blue-800">
                Kelola Video <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>

        <!-- Card Galeri -->
        <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-gray-700">Total Galeri</h3>
                    <p class="text-3xl font-bold text-purple-600">{{ $totalGalleries }}</p>
                </div>
                <i class="fas fa-image text-4xl text-purple-500"></i>
            </div>
            <a href="{{ route('admin.galleries.index') }}" class="mt-4 inline-block text-purple-600 hover:text-purple-800">
                Kelola Galeri <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>

    <!-- Card I'tikaf -->
    <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-xl font-semibold text-gray-700">Total I'tikaf</h3>
                <p class="text-3xl font-bold text-indigo-600">{{ $totalItikaf }}</p>
            </div>
            <i class="fas fa-mosque text-4xl text-indigo-500"></i>
        </div>
        <a href="{{ route('admin.itikaf.index') }}" class="mt-4 inline-block text-indigo-600 hover:text-indigo-800">
            Lihat Jemaah<i class="fas fa-arrow-right ml-2"></i>
        </a>
    </div>


    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <a href="{{ route('admin.articles.create') }}" class="bg-green-100 p-6 rounded-xl text-center hover:bg-green-200 transition-colors">
            <i class="fas fa-plus-circle text-4xl text-green-600 mb-4"></i>
            <h4 class="font-semibold text-green-800">Tambah Artikel</h4>
        </a>

        <a href="{{ route('admin.announcements.create') }}" class="bg-blue-100 p-6 rounded-xl text-center hover:bg-blue-200 transition-colors">
            <i class="fas fa-bullhorn text-4xl text-blue-600 mb-4"></i>
            <h4 class="font-semibold text-blue-800">Buat Pengumuman</h4>
        </a>

        <a href="{{ route('admin.programs.create') }}" class="bg-amber-100 p-6 rounded-xl text-center hover:bg-amber-200 transition-colors">
            <i class="fas fa-calendar-alt text-4xl text-amber-600 mb-4"></i>
            <h4 class="font-semibold text-amber-800">Tambah Program</h4>
        </a>

        <a href="{{ route('admin.videos.create') }}" class="bg-red-100 p-6 rounded-xl text-center hover:bg-red-200 transition-colors">
            <i class="fas fa-film text-4xl text-red-600 mb-4"></i>
            <h4 class="font-semibold text-red-800">Upload Video</h4>
        </a>
    </div>
</div>
@endsection