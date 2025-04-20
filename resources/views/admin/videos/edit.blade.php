@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Edit Video</h1>
    
    <form action="{{ route('admin.videos.update', $video->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
            <input type="text" name="title" id="title" value="{{ $video->title }}" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        </div>
        <div class="mb-4">
            <label for="ustadz" class="block text-sm font-medium text-gray-700">Ustadz</label>
            <input type="text" name="ustadz" id="ustadz" value="{{ $video->ustadz }}" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        </div>
        <div class="mb-4">
            <label for="date" class="block text-sm font-medium text-gray-700">Tanggal</label>
            <input type="date" name="date" id="date" value="{{ $video->date->format('Y-m-d') }}" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        </div>
        <div class="mb-4">
            <label for="embed_id" class="block text-sm font-medium text-gray-700">ID Embed YouTube (Contoh: dQw4w9WgXcQ)</label>
            <input type="text" name="embed_id" id="embed_id" value="{{ $video->embed_id }}" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        </div>
        <div class="mb-4">
            <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
            <select name="category" id="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                <option value="">Pilih kategori</option>
                <option value="harian" {{ $video->category == 'kajian_harian' ? 'selected' : '' }}>Kajian Harian</option>
                <option value="mingguan" {{ $video->category == 'kajian_mingguan' ? 'selected' : '' }}>Kajian Mingguan</option>
                <option value="bulanan" {{ $video->category == 'kajian_bulanan' ? 'selected' : '' }}>Kajian Bulanan</option>
                <option value="akbar" {{ $video->category == 'kajian_akbar' ? 'selected' : '' }}>Kajian Akbar</option>
            </select>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Video</button>
    </form>
</div>

<script>
document.getElementById('embed_id').addEventListener('input', function(e) {
    const url = e.target.value.trim();
    const extractYouTubeID = (url) => {
        try {
            const parsedUrl = new URL(url);
            if (parsedUrl.hostname.includes('youtube.com') || parsedUrl.hostname.includes('youtu.be')) {
                // Handle embed URLs
                if (parsedUrl.pathname.startsWith('/embed/')) {
                    const idPart = parsedUrl.pathname.split('/')[2];
                    return idPart ? idPart.split(/[^a-zA-Z0-9_-]/)[0] : url;
                }
                // Handle shortened URLs
                if (parsedUrl.hostname.includes('youtu.be')) {
                    const idPart = parsedUrl.pathname.split('/')[1];
                    return idPart ? idPart.split(/[^a-zA-Z0-9_-]/)[0] : url;
                }
                // Handle standard URLs
                const vParam = parsedUrl.searchParams.get('v');
                if (vParam) return vParam.split(/[^a-zA-Z0-9_-]/)[0];
            }
            return url;
        } catch (error) {
            return url;
        }
    };
    e.target.value = extractYouTubeID(url);
});
</script>
@endsection