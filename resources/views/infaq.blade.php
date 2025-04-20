<!-- resources/views/infaq.blade.php -->
@extends('layout.app')

@section('content')
    <section class="container mx-auto px-4 py-16">
        <!-- Judul Halaman -->
        <h1 class="text-3xl font-bold text-green-800 mb-8 text-center">
            <i class="fas fa-hand-holding-heart mr-2"></i>Halaman Infaq
        </h1>

        <!-- QRIS Section -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-8 w-full md:max-w-md mx-auto">
            <h2 class="text-2xl font-semibold text-green-800 mb-4">
                <i class="fas fa-qrcode mr-2"></i>Bayar dengan QRIS
            </h2>
            <p class="text-gray-600 mb-4">
                Scan QRIS di bawah ini untuk melakukan infaq secara cepat dan mudah:
            </p>
            <div class="flex justify-center">
                <img src="{{ asset('qrisalfirdaus.jpg') }}" alt="QRIS Masjid Al-Firdaus" class="h-auto w-full">
            </div>
        </div>

        <!-- Informasi Rekening -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-8">
            <h2 class="text-2xl font-semibold text-green-800 mb-4">
                <i class="fas fa-university mr-2"></i>Transfer via Bank
            </h2>
            <p class="text-gray-600 mb-4">
                Anda juga dapat melakukan infaq melalui transfer bank ke rekening berikut:
            </p>
            <div class="space-y-4">
                <!-- Rekening 1 -->
                <div class="bg-green-50 p-4 rounded-lg">
                    <p class="font-semibold text-green-800">QRIS BSI</p>
                    <p class="text-gray-600">Nomor Rekening: <span class="font-mono">2024009095</span></p>
                    <p class="text-gray-600">Atas Nama: <span class="font-semibold">MASJID AL FIRDAUS KADIPATEN</span></p>
                </div>
                <!-- Rekening 2
                <div class="bg-green-50 p-4 rounded-lg">
                    <p class="font-semibold text-green-800">Bank BCA</p>
                    <p class="text-gray-600">Nomor Rekening: <span class="font-mono">9876 5432 1098</span></p>
                    <p class="text-gray-600">Atas Nama: <span class="font-semibold">Masjid Al-Firdaus</span></p>
                </div>
                <!-- Rekening 3
                <div class="bg-green-50 p-4 rounded-lg">
                    <p class="font-semibold text-green-800">Bank Syariah Indonesia (BSI)</p>
                    <p class="text-gray-600">Nomor Rekening: <span class="font-mono">5678 1234 9876</span></p>
                    <p class="text-gray-600">Atas Nama: <span class="font-semibold">Masjid Al-Firdaus</span></p>
                </div> -->
            </div>
        </div>

        <!-- Instruksi Infaq -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold text-green-800 mb-4">
                <i class="fas fa-info-circle mr-2"></i>Cara Melakukan Infaq
            </h2>
            <div class="space-y-4 text-gray-600">
                <p>
                    1. Untuk pembayaran via QRIS, scan kode QR di atas menggunakan aplikasi e-wallet atau mobile banking yang mendukung QRIS.
                </p>
                <p>
                    2. Untuk pembayaran via transfer bank, gunakan nomor rekening yang tertera di atas. Pastikan Anda mentransfer ke rekening yang benar.
                </p>
                <p>
                    3. Setelah melakukan infaq, silakan konfirmasi dengan mengirimkan bukti transfer ke nomor WhatsApp berikut: <span class="font-semibold text-green-800">0812 3456 7890</span>.
                </p>
                <p>
                    4. Jazakumullahu khairan atas infaq yang diberikan. Semoga menjadi amal jariyah yang berkah.
                </p>
            </div>
        </div>
    </section>
@endsection