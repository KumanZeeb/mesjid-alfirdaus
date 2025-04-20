<div class="bg-white p-6 rounded-lg shadow-md">
    <h3 class="text-xl font-bold mb-4 text-green-800">
        <i class="fas fa-bullhorn mr-2"></i> Pengumuman Terbaru
    </h3>
    
    <ul class="space-y-4">
        @forelse($announcements as $announcement)
        <li class="border-l-4 border-green-500 pl-4">
            <p class="font-semibold">{{ $announcement->title }}</p>
            <p class="text-sm text-gray-600">{{ $announcement->detail }}</p>
            <p class="text-xs text-gray-500 mt-1">
                {{ $announcement->created_at->diffForHumans() }}
            </p>
        </li>
        @empty
        <li class="text-gray-500 text-sm italic">
            <i class="fas fa-info-circle mr-1"></i>Tidak ada pengumuman terbaru
        </li>
        @endforelse
    </ul>
</div>