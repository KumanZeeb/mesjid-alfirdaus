        <section class="bg-green-50 py-16">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-green-800 mb-8 text-center">
                    <i class="fas fa-video mr-3"></i>Video Dakwah Terbaru
                </h2>
                
                @forelse($videos as $video)
                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h3 class="font-bold text-lg mb-2">{{ $video->title }}</h3>
                            <p class="text-sm text-gray-600 mb-4">{{ $video->date->format('d M Y') }} • {{ $video->ustadz }}</p>
                            <div class="aspect-w-16 aspect-h-9">
                                <iframe 
                                    class="w-full h-64 rounded-lg"
                                    src="https://www.youtube.com/embed/{{ $video->embed_id }}" 
                                    frameborder="0"     
                                    allowfullscreen>
                                </iframe>
                            </div>
                            <a 
                                href="https://youtu.be/{{ $video->embed_id }}" 
                                target="_blank"
                                class="mt-4 text-green-600 hover:text-green-700 flex items-center"
                            >
                                <i class="fab fa-youtube mr-2"></i>Tonton di YouTube
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 bg-white rounded-lg shadow-md">
                        <p class="text-xl text-gray-600">
                            <i class="fas fa-video-slash text-4xl mb-4"></i><br>
                            Wahh sepertinya video nya belum tersedia, InsyaAllah kami akan segera menambahkannya 
                        </p>
                    </div>
                @endforelse
            </div>
        </section>