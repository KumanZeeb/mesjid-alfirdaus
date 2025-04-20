<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kumpulan Artikel - Masjid Al-Firdaus</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="bg-gray-50">
  <!-- Header -->
  <header class="fixed top-0 left-0 w-full bg-gradient-to-r from-green-700 to-green-800 shadow-lg z-50">
    @include('partials.header')
  </header>

  <!-- Hero Section -->
  <section class="relative h-96 flex items-center justify-center text-center bg-cover bg-center" style="background-image: url('https://images.pexels.com/photos/318451/pexels-photo-318451.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    <div class="relative z-10 px-4">
      <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
        <i class="fas fa-book-open mr-3"></i>Kumpulan Artikel
      </h1>
      <p class="text-lg text-green-100 max-w-2xl mx-auto">
        Temukan artikel-artikel islami berkualitas seputar ibadah, akidah, dan kehidupan muslim sehari-hari.
      </p>
    </div>
  </section>

  <!-- Konten utama -->
  <main class="container mx-auto px-4 py-12">
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
            {{ Str::limit($featuredArticle->content, 150) }}
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

    <!-- Kategori -->
    <div class="mb-12">
      <h3 class="text-xl font-bold text-gray-800 mb-6">Telusuri Berdasarkan Kategori</h3>
      <div class="flex flex-wrap gap-3">
        @foreach ($categories as $category)
          <a href="#" class="px-4 py-2 bg-green-100 text-green-800 rounded-full hover:bg-green-200 transition-colors">{{ $category }}</a>
        @endforeach
      </div>
    </div>

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

    <!-- Pagination -->
    <div class="flex justify-center mt-12 space-x-2">
      {{ $articles->links() }}
    </div>
  </main>

  <!-- Footer -->
  @include('partials.footer')
</body>
</html>