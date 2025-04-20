@extends('layout.app')

@section('content')
    <!-- Detail Artikel -->
    <section class="container mx-auto px-4 py-12">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <!-- Judul Artikel -->
            <h1 class="text-3xl font-bold text-green-800 mb-4 border-b-2 border-green-200 pb-2">
                {{ $article->title }}
            </h1>

            <!-- Thumbnail -->
            @if($article->image)
                <img src="{{ asset('storage/' . $article->image) }}" 
                    alt="{{ $article->title }}"
                    class="w-full h-64 object-cover mb-4 rounded-lg shadow-md hover:scale-105 transition-transform">
            @else
                <div class="w-full h-64 bg-gray-200 mb-4 rounded-lg flex items-center justify-center">
                    <span class="text-gray-500">No Image</span>
                </div>
            @endif

            <!-- Konten Artikel -->
            <div class="text-gray-700 prose max-w-none whitespace-pre-wrap">
                @php
                    // Ambil konten artikel
                    $content = $article->content;

                    // Konversi ## Judul → <h2>
                    $content = preg_replace('/^##\s+(.*)$/m', '<h2>$1</h2>', $content);

                    // Konversi **teks** → <strong>
                    $content = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $content);

                    // Konversi > Kutipan → <blockquote>
                    $content = preg_replace('/^>\s*(.*)/m', '<blockquote>$1</blockquote>', $content);

                    // Tambahkan line breaks hanya jika tidak dalam tag tertentu
                    $content = preg_replace('/(?<!<\/h2>|<\/strong>|<\/blockquote>)\n/', "<br>\n", $content);
                @endphp
                {!! clean($content, ['HTML.Allowed' => 'p,br,strong,em,blockquote,h2,h3,ul,li']) !!}
            </div>
        </div>
    </section>

    <!-- resources/views/articles/show.blade.php -->
    <section class="container mx-auto px-4 py-12">
        <!-- Featured Article -->
        @if($featuredArticle)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-12 hover:shadow-xl transition-shadow duration-300">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <!-- Gambar -->
                    <div class="h-64 md:h-auto bg-cover bg-center" style="background-image: url('{{ $featuredArticle->image ? asset('storage/' . $featuredArticle->image) : 'https://source.unsplash.com/800x600/?islamic' }}');"></div>
                    <!-- Konten -->
                    <div class="p-8">
                        <div class="mb-4">
                            <span class="inline-block bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full">{{ $featuredArticle->category }}</span>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ $featuredArticle->title }}</h2>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            @php
                                // Hapus markdown dari konten
                                $content = preg_replace('/##\s*/', '', $featuredArticle->content);
                                $content = preg_replace('/\*\*(.*?)\*\*/', '$1', $content);
                                $content = preg_replace('/>\s*/', '', $content);
                            @endphp
                            {{ Str::limit($content, 150) }}
                        </p>
                        <a href="{{ route('articles.show', $featuredArticle->slug) }}" class="inline-flex items-center text-green-600 hover:text-green-800 font-semibold">
                            Baca Selengkapnya
                            <i class="fas fa-arrow-right ml-2 text-sm"></i>
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-12 hover:shadow-xl transition-shadow duration-300">
                <div class="p-8 text-center">
                    <p class="text-gray-600">Belum ada artikel yang tersedia.</p>
                </div>
            </div>
        @endif

        <!-- Daftar Artikel Terbaru -->
        <h3 class="text-xl font-bold text-gray-800 mb-6">Baca Artikel Terbaru Kami</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($articles as $article)
                <article class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300">
                    <!-- Gambar -->
                    <div class="h-48 bg-cover bg-center rounded-t-xl" style="background-image: url('{{ $article->image ? asset('storage/' . $article->image) : 'https://source.unsplash.com/600x400/?islamic' }}');"></div>
                    <!-- Konten -->
                    <div class="p-6">
                        <div class="mb-4">
                            <span class="inline-block bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full">{{ $article->category }}</span>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800 mb-3">{{ $article->title }}</h2>
                        <p class="text-gray-600 mb-4 leading-relaxed">
                            @php
                                // Hapus markdown dari konten
                                $content = preg_replace('/##\s*/', '', $article->content);
                                $content = preg_replace('/\*\*(.*?)\*\*/', '$1', $content);
                                $content = preg_replace('/>\s*/', '', $content);
                            @endphp
                            {{ Str::limit($content, 100) }}
                        </p>
                        <div class="flex items-center justify-between">
                            <a href="{{ route('articles.show', $article->slug) }}" class="text-green-600 hover:text-green-800 font-semibold flex items-center">
                                Baca Selengkapnya
                                <i class="fas fa-arrow-right ml-2 text-sm"></i>
                            </a>
                            <span class="text-sm text-gray-500">{{ rand(3, 10) }} min baca</span>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-12 space-x-2">
            {{ $articles->links() }}
        </div>
    </section>
@endsection