@extends('layout.app')

@section('content')
<section class="bg-green-50 py-8 sm:py-16">
    <div class="container mx-auto px-4">
        <!-- Judul Section -->
        <h2 class="text-2xl sm:text-3xl font-bold text-green-800 mb-6 sm:mb-8 text-center">
            <i class="fas fa-video mr-3"></i>Kajian Harian
        </h2>

        @if($videos->isEmpty())
            <p class="text-center text-gray-600">Tidak ada video untuk kategori ini.</p>
        @else
            <!-- Player Video Utama -->
            <div class="relative bg-white shadow-lg rounded-lg overflow-hidden mb-8 sticky top-24 z-40">
                <div class="aspect-w-16 aspect-h-9 sm:aspect-h-7 lg:aspect-h-13">
                    @php
                        $cleanEmbedId = explode('?', $videos->first()->embed_id)[0];
                    @endphp
                    <iframe 
                        id="main-video"
                        class="w-full h-full"
                        src="https://www.youtube.com/embed/{{ $cleanEmbedId }}" 
                        frameborder="0" 
                        allow="autoplay; encrypted-media" 
                        allowfullscreen
                    ></iframe>
                </div>
                <div class="p-4">
                    <h3 id="video-title" class="font-bold text-lg sm:text-xl">{{ $videos->first()->title }}</h3>
                    <p id="video-info" class="text-sm text-gray-600 mt-2">{{ $videos->first()->ustadz }} • {{ $videos->first()->date }}</p>
                </div>
            </div>

            <!-- Daftar Video Lainnya -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mt-8 sm:mt-12">
                @foreach($videos as $video)
                @php
                    $cleanEmbedId = explode('?', $video->embed_id)[0];
                @endphp
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <!-- Thumbnail Video -->
                    <div class="relative aspect-w-16 aspect-h-9 bg-gray-200 rounded-t-lg overflow-hidden">
                        <img 
                            src="https://img.youtube.com/vi/{{ $cleanEmbedId }}/maxresdefault.jpg" 
                            onerror="this.onerror=null; this.src='https://img.youtube.com/vi/{{ $cleanEmbedId }}/hqdefault.jpg'"
                            alt="Thumbnail video {{ $video->title }}" 
                            class="w-full h-full object-cover"
                        >
                        <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30 hover:bg-opacity-50 transition-opacity duration-300">
                            <i class="fas fa-play text-white text-4xl"></i>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-base sm:text-lg mb-2 line-clamp-2">{{ $video->title }}</h3>
                        <p class="text-sm text-gray-600 mb-2">{{ $video->ustadz }}</p>
                        <p class="text-xs text-gray-500">{{ $video->date }}</p>
                    </div>
                    <button 
                        class="w-full bg-green-500 text-white text-center py-2 rounded-b-lg hover:bg-green-600 transition-colors duration-300 video-link"
                        data-video-id="{{ $cleanEmbedId }}"
                        data-video-title="{{ $video->title }}"
                        data-video-ustadz="{{ $video->ustadz }}"
                        data-video-date="{{ $video->date }}"
                    >
                        <i class="fas fa-play mr-2"></i>Tonton
                    </button>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const videoIframe = document.getElementById('main-video');
    const videoTitle = document.getElementById('video-title');
    const videoInfo = document.getElementById('video-info');
    const videoLinks = document.querySelectorAll('.video-link');

    videoLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault(); 
            const videoId = this.dataset.videoId;
            const title = this.dataset.videoTitle;
            const ustadz = this.dataset.videoUstadz;
            const date = this.dataset.videoDate;

            if (videoId) {
                videoIframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
            }
            if (title && ustadz && date) {
                videoTitle.textContent = title;
                videoInfo.textContent = `${ustadz} • ${date}`;
            }
        });
    });
});
</script>
@endsection
