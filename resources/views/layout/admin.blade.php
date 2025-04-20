<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Admin Panel - Masjid Al-Firdaus</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .glass {
            background: rgba(255, 255, 255, 0.99);
            backdrop-filter: blur(10px);
            border: 1px solid rgb(104, 238, 86);
        }

        .neumorphism {
            border-radius: 20px;
            background: #f0f0f0;
            box-shadow: 10px 10px 20px #d9d9d9, 
                       -10px -10px 20px #ffffff;
        }

        .hover-scale {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .hover-scale:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 4px;
        }

        /* Animasi Modal */
        #modal {
            transition: opacity 0.3s ease;
        }

        .modal-content {
            transition: transform 0.3s ease;
            transform: translateY(-50px);
        }

        .modal-show .modal-content {
            transform: translateY(0);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-green-50 to-green-100 min-h-screen">
    <!-- Top Navigation -->
    <nav class="glass fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-green-600 rounded-lg shadow-lg">
                        <i class="fas fa-mosque text-white text-2xl"></i>
                    </div>
                    <h1 class="text-xl font-bold text-green-800">
                        Masjid Al-Firdaus
                    </h1>
                </div>
                <div class="flex items-center space-x-4">
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="flex items-center text-green-700 hover:text-green-900 transition-colors">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            <span class="hidden sm:inline">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-20 pb-8 px-4 sm:px-6 lg:px-8">
        <!-- Dashboard Header -->
        <div class="max-w-7xl mx-auto mb-8">
            <div class="glass rounded-2xl p-6 shadow-2xl">
                <h2 class="text-2xl font-bold text-green-900">Selamat Datang, Admin</h2>
                <p class="text-green-700 mt-2">Kelola konten masjid dengan mudah dan modern</p>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Pengumuman Card -->
            <div class="neumorphism hover-scale p-6 rounded-2xl">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-green-800">
                        <i class="fas fa-bullhorn text-green-600 mr-2"></i>Pengumuman
                    </h3>
                    <button onclick="openModal('addAnnouncement')" 
                            class="p-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-colors">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                <div class="space-y-4">
                    @foreach($announcements as $announcement)
                    <div class="glass p-4 rounded-lg">
                        <h4 class="font-medium text-green-900">{{ $announcement->title }}</h4>
                        <p class="text-sm text-green-700 mt-1 truncate">{{ $announcement->description }}</p>
                        <div class="flex justify-end space-x-2 mt-3">
                            <button onclick="openModal('editAnnouncement', {{ $announcement->id }})" 
                                    class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-pen"></i>
                            </button>
                            <form method="POST" action="{{ route('admin.announcements.destroy', $announcement->id) }}">
                                @csrf @method('DELETE')
                                <button type="submit" 
                                        class="text-red-500 hover:text-red-700"
                                        onclick="return confirm('Hapus pengumuman ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Program Card -->
            <div class="neumorphism hover-scale p-6 rounded-2xl">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-green-800">
                        <i class="fas fa-calendar-alt text-green-600 mr-2"></i>Program
                    </h3>
                    <button onclick="openModal('addProgram')" 
                            class="p-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-colors">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                <div class="space-y-4">
                    @foreach($programs as $program)
                    <div class="glass p-4 rounded-lg">
                        <h4 class="font-medium text-green-900">{{ $program->title }}</h4>
                        <p class="text-sm text-green-700 mt-1 truncate">{{ $program->description }}</p>
                        <div class="flex justify-end space-x-2 mt-3">
                            <button onclick="openModal('editProgram', {{ $program->id }})" 
                                    class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-pen"></i>
                            </button>
                            <form method="POST" action="{{ route('admin.programs.destroy', $program->id) }}">
                                @csrf @method('DELETE')
                                <button type="submit" 
                                        class="text-red-500 hover:text-red-700"
                                        onclick="return confirm('Hapus program ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Galeri Card -->
            <div class="neumorphism hover-scale p-6 rounded-2xl">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-green-800">
                        <i class="fas fa-images text-green-600 mr-2"></i>Galeri
                    </h3>
                    <button onclick="openModal('addGallery')" 
                            class="p-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-colors">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    @foreach($galleries as $gallery)
                    <div class="relative group">
                        <img src="{{ asset('storage/' . $gallery->image) }}" 
                             alt="{{ $gallery->title }}"
                             class="w-full h-32 object-cover rounded-lg">
                        <div class="absolute inset-0 bg-black bg-opacity-50 hidden group-hover:flex items-center justify-center space-x-2 rounded-lg">
                            <button onclick="openModal('editGallery', {{ $gallery->id }})" 
                                    class="text-white hover:text-blue-300">
                                <i class="fas fa-pen"></i>
                            </button>
                            <form method="POST" action="{{ route('admin.galleries.destroy', $gallery->id) }}">
                                @csrf @method('DELETE')
                                <button type="submit" 
                                        class="text-white hover:text-red-300"
                                        onclick="return confirm('Hapus galeri ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Video Card -->
            <div class="neumorphism hover-scale p-6 rounded-2xl">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-green-800">
                        <i class="fas fa-video text-green-600 mr-2"></i>Video
                    </h3>
                    <button onclick="openModal('addVideo')" 
                            class="p-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-colors">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                <div class="space-y-4">
                    @foreach($videos as $video)
                    <div class="glass p-4 rounded-lg">
                        <div class="aspect-w-16 aspect-h-9">
                            <iframe src="{{ $video->url }}" 
                                    class="w-full rounded-lg" 
                                    frameborder="0" 
                                    allowfullscreen></iframe>
                        </div>
                        <h4 class="font-medium text-green-900 mt-2">{{ $video->title }}</h4>
                        <div class="flex justify-end space-x-2 mt-3">
                            <button onclick="openModal('editVideo', {{ $video->id }})" 
                                    class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-pen"></i>
                            </button>
                            <form method="POST" action="{{ route('admin.videos.destroy', $video->id) }}">
                                @csrf @method('DELETE')
                                <button type="submit" 
                                        class="text-red-500 hover:text-red-700"
                                        onclick="return confirm('Hapus video ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Artikel Card -->
            <div class="neumorphism hover-scale p-6 rounded-2xl">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-green-800">
                        <i class="fas fa-newspaper text-green-600 mr-2"></i>Artikel
                    </h3>
                    <button onclick="openModal('addArticle')" 
                            class="p-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-colors">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                <div class="space-y-4">
                    @foreach($articles as $article)
                    <div class="glass p-4 rounded-lg">
                        <h4 class="font-medium text-green-900">{{ $article->title }}</h4>
                        <div class="text-sm text-green-700 mt-1 line-clamp-2">
                            {!! $article->content !!}
                        </div>
                        <div class="flex justify-end space-x-2 mt-3">
                            <button onclick="openModal('editArticle', {{ $article->id }})" 
                                    class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-pen"></i>
                            </button>
                            <form method="POST" action="{{ route('admin.articles.destroy', $article->id) }}">
                                @csrf @method('DELETE')
                                <button type="submit" 
                                        class="text-red-500 hover:text-red-700"
                                        onclick="return confirm('Hapus artikel ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center p-4 z-50" role="dialog" aria-modal="true">
        <div class="glass rounded-2xl w-full max-w-md max-h-[90vh] overflow-y-auto modal-content transform transition-all">
            <div class="flex justify-between items-center p-4 border-b border-green-200">
                <h3 class="text-lg font-semibold text-green-900" id="modalTitle"></h3>
                <button onclick="closeModal()" class="text-green-700 hover:text-green-900">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="modalContent" class="p-4">
                <!-- Konten modal akan dimuat di sini -->
            </div>
        </div>
    </div>

    <script>
        // Fungsi Modal
        async function openModal(type, id = null) {
            const modalContent = document.getElementById('modalContent');
            let url = '';

            modalContent.innerHTML = `
                <div class="text-center py-6 space-y-2">
                    <div class="animate-spin inline-block w-8 h-8 border-4 border-green-500 rounded-full border-t-transparent"></div>
                    <p class="text-sm text-green-700">Memuat formulir...</p>
                </div>
            `;

            switch(type) {
                case 'addAnnouncement':
                    url = "{{ route('admin.announcements.create') }}";
                    break;
                case 'editAnnouncement':
                    url = `/admin/announcements/${id}/edit`;
                    break;
                case 'addProgram':
                    url = "{{ route('admin.programs.create') }}";
                    break;
                case 'editProgram':
                    url = `/admin/programs/${id}/edit`;
                    break;
                case 'addGallery':
                    url = "{{ route('admin.galleries.create') }}";
                    break;
                case 'editGallery':
                    url = `/admin/galleries/${id}/edit`;
                    break;
                case 'addVideo':
                    url = "{{ route('admin.video.create') }}";
                    break;
                case 'editVideo':
                    url = `/admin/video/${id}/edit`;
                    break;
                case 'addArticle':
                    url = "{{ route('admin.articles.create') }}";
                    break;
                case 'editArticle':
                    url = `/admin/articles/${id}/edit`;
                    break;
            }

            if (!url) {
                console.error('URL tidak valid');
                return;
            }

            try {
                const response = await fetch(url);
                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                const data = await response.text();
                modalContent.innerHTML = data;
                document.getElementById('modal').classList.remove('hidden');
            } catch (error) {
                modalContent.innerHTML = `
                    <div class="text-center py-6">
                        <i class="fas fa-exclamation-triangle text-2xl text-red-500"></i>
                        <p class="mt-2 text-green-700">Error: ${error.message}</p>
                    </div>
                `;
                console.error('Error:', error);
            }
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }

        document.addEventListener('click', (e) => {
            if (e.target.id === 'modal' || e.target.classList.contains('close-modal')) {
                closeModal();
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        // Handle form submission dalam modal
        document.addEventListener('submit', async (e) => {
            if (e.target.closest('#modalContent form')) {
                e.preventDefault();
                const form = e.target;
                try {
                    const response = await fetch(form.action, {
                        method: form.method,
                        body: new FormData(form)
                    });
                    
                    if (response.ok) {
                        closeModal();
                        window.location.reload(); // Refresh data setelah submit
                    }
                } catch (error) {
                    console.error('Form submission error:', error);
                }
            }
        });
    </script>
</body>
</html>