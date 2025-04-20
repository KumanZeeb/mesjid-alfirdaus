<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Masjid Al-Firdaus</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="bg-green-800 w-64 min-h-screen p-4 fixed">
            <div class="mb-8">
                <h2 class="text-white text-2xl font-bold">Admin Panel</h2>
                <p class="text-green-200">Masjid Al-Firdaus</p>
            </div>
            <nav>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center text-white p-2 rounded hover:bg-green-700">
                            <i class="fas fa-home mr-3"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.articles.index') }}" class="flex items-center text-white p-2 rounded hover:bg-green-700">
                            <i class="fas fa-newspaper mr-3"></i> Artikel
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.announcements.index') }}" class="flex items-center text-white p-2 rounded hover:bg-green-700">
                            <i class="fas fa-bullhorn mr-3"></i> Pengumuman
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.programs.index') }}" class="flex items-center text-white p-2 rounded hover:bg-green-700">
                            <i class="fas fa-calendar-alt mr-3"></i> Program
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.galleries.index') }}" class="flex items-center text-white p-2 rounded hover:bg-green-700">
                            <i class="fas fa-image mr-3"></i> Galeri
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.videos.index') }}" class="flex items-center text-white p-2 rounded hover:bg-green-700">
                            <i class="fas fa-video mr-3"></i> Video
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64 p-8">
            @yield('content')
        </main>
    </div>
</body>
</html>