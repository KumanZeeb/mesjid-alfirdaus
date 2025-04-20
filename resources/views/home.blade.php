@extends('layout.app')

@section('content')

    <!-- Hero Section -->
    <section class="bg-[url('https://images.unsplash.com/photo-1587617425953-9075d28b8c46')] bg-cover bg-center">
        <div class="bg-black/60 py-16">
            <div class="container mx-auto px-4 text-center text-white">
                <h2 class="text-4xl font-bold mb-4">Selamat Datang di Masjid Al-Firdaus</h2>
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4 max-w-4xl mx-auto" id="livePrayerTimes"></div>
                <div class="mt-8">
                    <p class="text-xl">Waktu Sholat Berikutnya: 
                        <span id="nextPrayer" class="font-bold"></span> 
                        dalam <span id="countdown" class="text-green-400"></span>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Fitur Utama -->
    <section class="container mx-auto px-4 py-16">
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Pengumuman -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-bold mb-4 text-green-800">
                    <i class="fas fa-bullhorn mr-2"></i> Pengumuman Terbaru
                </h3>
                <ul class="space-y-4">
                    @foreach($announcements as $announcement)
                    <li class="border-l-4 border-green-500 pl-4">
                        <p class="font-semibold">{{ $announcement->title }}</p>
                        <p class="text-sm text-gray-600">{{ $announcement->detail }}</p>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Program Unggulan -->
            <div class="container mx-auto px-4 py-8">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold mb-4 text-green-800">
                        <i class="fas fa-calendar-star mr-2"></i> Program Unggulan
                    </h3>
                    <div class="space-y-4">
                        @foreach($programs as $program)
                        <div class="flex items-start">
                            <div class="bg-green-100 p-2 rounded mr-3">
                                <i class="{{ $program->icon_class }} text-green-600"></i>
                            </div>
                            <div>
                                <p class="font-semibold">{{ $program->name }}</p>
                                <p class="text-sm text-gray-600">{{ $program->schedule }}</p>
                                
                                @if($program->has_form)
                                <!-- Tombol untuk membuka modal -->
                                <button 
                                    onclick="openModal('{{ $program->id }}', '{{ $program->name }}')" 
                                    class="mt-2 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600"
                                >
                                    Daftar
                                </button>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div id="modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
                <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                    <h3 id="modalTitle" class="text-xl font-bold mb-4">Form <span id="programName"></span></h3>
                    <form id="modalForm" method="POST">
                        @csrf
                        <!-- Nama Lengkap -->
                        <div class="mb-4">
                            <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>

                        <!-- Umur -->
                        <div class="mb-4">
                            <label for="umur" class="block text-sm font-medium text-gray-700">Umur</label>
                            <input type="number" name="umur" id="umur" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>

                        <!-- Alamat -->
                        <div class="mb-4">
                            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                            <textarea name="alamat" id="alamat" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required></textarea>
                        </div>

                        <!-- Tanggal Masuk -->
                        <div class="mb-4">
                            <label for="tanggal_masuk" class="block text-sm font-medium text-gray-700">Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>

                        <!-- Tanggal Keluar -->
                        <div class="mb-4">
                            <label for="tanggal_keluar" class="block text-sm font-medium text-gray-700">Tanggal Keluar</label>
                            <input type="date" name="tanggal_keluar" id="tanggal_keluar" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>

                        <!-- Tombol -->
                        <div class="flex justify-end space-x-2">
                            <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Tutup</button>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

            <script>
                // Fungsi untuk membuka modal
                function openModal(programId, programName) {
                    // Set judul modal
                    document.getElementById('programName').textContent = programName;

                    // Set action form sesuai dengan program yang dipilih
                    document.getElementById('modalForm').action = `/itikaf-form/${programId}`;

                    // Tampilkan modal
                    document.getElementById('modal').classList.remove('hidden');
                }

                // Fungsi untuk menutup modal
                function closeModal() {
                    document.getElementById('modal').classList.add('hidden');
                }

                // Tutup modal jika mengklik di luar modal
                document.getElementById('modal').addEventListener('click', function(event) {
                    if (event.target === this) {
                        closeModal();
                    }
                });
            </script>


            <!-- Statistik -->
            <!-- <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-bold mb-4 text-green-800">
                    <i class="fas fa-chart-line mr-2"></i> Pencapaian
                </h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-3xl font-bold text-green-600">1,234</p>
                        <p class="text-sm text-gray-600">Jamaah Terdaftar</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-green-600">85%</p>
                        <p class="text-sm text-gray-600">Target Pembangunan</p>
                        <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                            <div class="bg-green-600 h-2 rounded-full" style="width: 85%"></div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </section>

    <section class="bg-green-50 py-16"> 
        <div class="container mx-auto px-4">
            <h2 class="text-2xl md:text-3xl font-bold text-green-800 mb-8 text-center">
                <i class="fas fa-video mr-3"></i>Kajian Terbaru (1 Bulan Terakhir)
            </h2>

            <div class="grid grid-cols-2 md:grid-cols-2 gap-4 md:gap-8">
                @foreach($videos->where('date', '>=', now()->subMonth())->take(4) as $index => $video)
                <div class="bg-white p-4 md:p-6 rounded-lg shadow-md video-item">
                    <h3 class="font-bold text-sm md:text-lg mb-2">{{ $video->title }}</h3>
                    <p class="text-xs md:text-sm text-gray-600 mb-3">{{ $video->date }} • {{ $video->ustadz }}</p>
                    <div class="aspect-w-16 aspect-h-9">
                        <iframe 
                            class="w-full h-40 md:h-64 rounded-lg"
                            src="https://www.youtube.com/embed/{{ $video->embed_id }}" 
                            frameborder="0" 
                            allowfullscreen>
                        </iframe>
                    </div>
                    <a 
                        href="https://youtu.be/{{ $video->embed_id }}" 
                        target="_blank"
                        class="mt-3 text-green-600 hover:text-green-700 flex items-center text-xs md:text-sm"
                    >
                        <i class="fab fa-youtube mr-2"></i>Tonton di YouTube
                    </a>
                </div>
                @endforeach
            </div>

            @if($videos->where('date', '>=', now()->subMonth())->count() > 4)
            <div class="text-center mt-6">
                <button id="showMore" class="bg-green-600 text-white px-4 py-2 rounded-md text-sm hover:bg-green-700">
                    Lihat Semua
                </button>
            </div>
            @endif
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let hiddenVideos = @json($videos->where('date', '>=', now()->subMonth())->skip(4)->values());
            let showMoreBtn = document.getElementById("showMore");
            let gridContainer = document.querySelector(".grid");

            if (hiddenVideos.length === 0) {
                showMoreBtn.style.display = "none";
            }

            showMoreBtn.addEventListener("click", function () {
                hiddenVideos.forEach(video => {
                    let videoDiv = document.createElement("div");
                    videoDiv.className = "bg-white p-4 md:p-6 rounded-lg shadow-md video-item";
                    videoDiv.innerHTML = `
                        <h3 class="font-bold text-sm md:text-lg mb-2">${video.title}</h3>
                        <p class="text-xs md:text-sm text-gray-600 mb-3">${video.date} • ${video.ustadz}</p>
                        <div class="aspect-w-16 aspect-h-9">
                            <iframe 
                                class="w-full h-40 md:h-64 rounded-lg"
                                src="https://www.youtube.com/embed/${video.embed_id}" 
                                frameborder="0" 
                                allowfullscreen>
                            </iframe>
                        </div>
                        <a 
                            href="https://youtu.be/${video.embed_id}" 
                            target="_blank"
                            class="mt-3 text-green-600 hover:text-green-700 flex items-center text-xs md:text-sm"
                        >
                            <i class="fab fa-youtube mr-2"></i>Tonton di YouTube
                        </a>
                    `;
                    gridContainer.appendChild(videoDiv);
                });

                showMoreBtn.style.display = "none"; // Sembunyikan tombol setelah ditekan
            });
        });
    </script>

    <!-- Galeri -->
    <section class="container mx-auto px-4 py-16">
        <h2 class="text-3xl font-bold text-green-800 mb-8 text-center">
            <i class="fas fa-camera mr-3"></i>Galeri Kegiatan
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($galleries as $gallery)
            <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->caption }}" class="w-full h-48 object-cover rounded-lg">
            @endforeach
        </div>
    </section>

    <section class="container mx-auto px-4 py-12">
        <h3 class="text-xl font-bold text-gray-800 mb-6 text-center">Baca Artikel Terbaru Kami</h3>
        
        <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4" id="article-container">
            @foreach ($articles as $index => $article)
                <article class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 p-4 {{ $index >= 4 ? 'hidden' : '' }}">
                    <!-- Gambar -->
                    <div class="h-32 bg-cover bg-center rounded-lg" style="background-image: url('{{ $article->image ? asset('storage/' . $article->image) : 'https://source.unsplash.com/600x400/?islamic' }}');"></div>
                    
                    <!-- Konten -->
                    <div class="mt-4">
                        <h2 class="text-sm font-bold text-gray-800 mb-2">{{ $article->title }}</h2>
                        
                        <p class="text-gray-600 mb-4 leading-relaxed">
                            @php
                                // Hapus markdown dari konten
                                $content = preg_replace('/##\s*/', '', $article->content);
                                $content = preg_replace('/\*\*(.*?)\*\*/', '$1', $content);
                                $content = preg_replace('/>\s*/', '', $content);
                            @endphp
                            {{ Str::limit($content, 100) }}
                        </p>
                        
                        <a href="{{ route('articles.show', $article->slug) }}" class="text-green-600 hover:text-green-800 font-semibold text-xs flex items-center">
                            Baca Selengkapnya <i class="fas fa-arrow-right ml-1 text-xs"></i>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        @if(count($articles) > 4)
            <div class="text-center mt-6">
                <button id="show-more" class="text-green-600 hover:text-green-800 font-semibold text-sm">Lihat Semua</button>
            </div>
        @endif
    </section>

    <script>
        document.getElementById('show-more')?.addEventListener('click', function() {
            document.querySelectorAll('#article-container .hidden').forEach(el => el.classList.remove('hidden'));
            this.style.display = 'none';
        });
    </script>
@endsection