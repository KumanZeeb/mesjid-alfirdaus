@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Data I'tikaf</h1>

    <table class="min-w-full bg-white border border-gray-300 shadow-md rounded-lg">
        <thead>
            <tr class="bg-gray-200 text-gray-700">
                <th class="py-2 px-4 border-b">#</th>
                <th class="py-2 px-4 border-b">Nama</th>
                <th class="py-2 px-4 border-b">Tanggal Masuk</th>
                <th class="py-2 px-4 border-b">Tanggal Keluar</th>
                <th class="py-2 px-4 border-b">Hari</th>
                <th class="py-2 px-4 border-b">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($itikafs as $index => $itikaf)
            <tr class="text-gray-700">
                <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                <td class="py-2 px-4 border-b">{{ $itikaf->nama_lengkap }}</td>
                <td class="py-2 px-4 border-b">{{ $itikaf->tanggal_masuk }}</td>
                <td class="py-2 px-4 border-b">{{ $itikaf->tanggal_keluar }}</td>
                <td class="py-2 px-4 border-b">
                    {{ \Carbon\Carbon::parse($itikaf->tanggal_masuk)->diffInDays(\Carbon\Carbon::parse($itikaf->tanggal_keluar)) }} Hari
                </td>
                <td class="py-2 px-4 border-b">
                    <button onclick="showItikaf({{ $itikaf->id }})" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                        Lihat Detail
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="flex space-x-2 mt-6">
        <a href="{{ route('admin.itikaf.download', ['format' => 'pdf']) }}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
            Download PDF
        </a>
        <a href="{{ route('admin.itikaf.download', ['format' => 'xls']) }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            Download Excel
        </a>
        <a href="{{ route('admin.itikaf.download', ['format' => 'image']) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Download Image
        </a>
    </div>
</div>

{{-- Modal --}}
<div id="itikafModal" class="hidden fixed inset-0 bg-gray-900/50 backdrop-blur-sm flex items-center justify-center p-4 z-50">
    <div id="itikafModalContent" class="bg-white p-6 rounded-lg shadow-xl max-w-lg w-full space-y-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-800">Detail I'tikaf</h2>
            <button onclick="closeModal()" class="text-gray-600 hover:text-red-500">&times;</button>
        </div>
        <div class="space-y-2">
            <p><strong>Nama:</strong> <span id="itikafNama"></span></p>
            <p><strong>Umur:</strong> <span id="itikafUmur"></span></p>
            <p><strong>Alamat:</strong> <span id="itikafAlamat"></span></p>
            <p><strong>Tanggal Masuk:</strong> <span id="itikafMasuk"></span></p>
            <p><strong>Tanggal Keluar:</strong> <span id="itikafKeluar"></span></p>
            <p><strong>Total Hari:</strong> <span id="itikafDurasi"></span> hari</p>
        </div>
        <div class="flex justify-end">
            <button onclick="closeModal()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Tutup</button>
        </div>
    </div>
</div>

<script>
    function showItikaf(id) {
        fetch(`/admin/itikaf/${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('itikafNama').textContent = data.nama_lengkap;
                document.getElementById('itikafUmur').textContent = data.umur + ' tahun';
                document.getElementById('itikafAlamat').textContent = data.alamat;
                document.getElementById('itikafMasuk').textContent = data.tanggal_masuk;
                document.getElementById('itikafKeluar').textContent = data.tanggal_keluar;

                const masuk = new Date(data.tanggal_masuk);
                const keluar = new Date(data.tanggal_keluar);
                const selisihHari = Math.floor((keluar - masuk) / (1000 * 60 * 60 * 24));
                document.getElementById('itikafDurasi').textContent = selisihHari;

                document.getElementById('itikafModal').classList.remove('hidden');
            })
            .catch(error => {
                alert("Gagal ambil data detail: " + error);
            });
    }

    function closeModal() {
        document.getElementById('itikafModal').classList.add('hidden');
    }
</script>
@endsection
