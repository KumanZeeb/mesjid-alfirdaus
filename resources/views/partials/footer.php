<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masjid Al-Firdaus</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <!-- Section Lokasi -->
    <section class="container mx-auto px-4 py-16">
        <h2 class="text-3xl font-bold text-green-800 mb-8 text-center">
            <i class="fas fa-map-marker-alt mr-3"></i>Lokasi Masjid
        </h2>
        <div class="grid md:grid-cols-2 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-bold mb-4">Alamat Lengkap</h3>
                <p class="mb-4">
                    Masjid Al Firdaus Kadipaten<br>
                    Jl. Raya Utara, Kadipaten<br>
                    Kec. Kadipaten, Kabupaten Majalengka<br>
                    Jawa Barat 45452<br>
                    Kode Lokasi: 65M9+C6R Kadipaten
                </p>
                
                <div class="mt-6 space-y-4">
                    <div class="flex items-center">
                        <i class="fas fa-car mr-3 text-green-600 text-xl"></i>
                        <div>
                            <p class="font-semibold">Akses Jalan</p>
                            <p class="text-sm text-gray-600">Terletak di pinggir jalan raya utama Kadipaten</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-praying-hands mr-3 text-green-600 text-xl"></i>
                        <div>
                            <p class="font-semibold">Fasilitas</p>
                            <p class="text-sm text-gray-600">Mushola wanita, parkir luas, dan toilet bersih</p>
                        </div>
                    </div>
                </div>

                <a 
                    href="https://maps.app.goo.gl/n6SidHwsrUefJZy79" 
                    target="_blank"
                    class="mt-6 inline-flex items-center bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors"
                >
                    <i class="fas fa-directions mr-2"></i>
                    Petunjuk Arah
                </a>
            </div>
            
            <div class="h-96 rounded-lg shadow-md overflow-hidden relative">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.028423941042!2d108.16543257499511!3d-6.766388593230378!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f29004742b5a7%3A0x9e0a8986b4e95640!2sMasjid%20Al%20Firdaus%20Kadipaten!5e0!3m2!1sid!2sid!4v1738045133886!5m2!1sid!2sid&markers=color:green%7Clabel:M%7C-6.7663886,108.1676113"
                    width="100%"
                    height="100%"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    class="rounded-lg">
                </iframe>
                
                <!-- Custom Marker -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-full">
                    <div class="animate-bounce">
                        <i class="fas fa-mosque text-3xl text-green-600 drop-shadow-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Chat -->
    <section class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Header Chat -->
            <div class="bg-green-600 p-4 flex items-center">
                <a href="#" class="text-white mr-3 md:hidden">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div class="flex items-center">
                    <div class="bg-green-100 p-2 rounded-full">
                        <i class="fas fa-mosque text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-3 text-white">
                        <p class="font-bold">Al-Firdaus</p>
                        <p class="text-xs opacity-80">Online</p>
                    </div>
                </div>
            </div>
    
            <!-- Isi Chat -->
            <div class="h-96 bg-gray-100 p-4 overflow-y-auto" id="chatContainer">
                <!-- Chat dari Admin -->
                <div class="flex mb-4">
                    <div class="flex-1">
                        <div class="bg-white rounded-lg p-3 shadow max-w-[70%]">
                            <p class="text-sm">Assalamu'alaikum, ada yang bisa kami bantu?</p>
                            <p class="text-xs text-gray-500 text-right mt-1">10:00</p>
                        </div>
                    </div>
                </div>
    
                <!-- Chat dari User -->
                <div class="flex mb-4 justify-end">
                    <div class="flex-1 flex justify-end">
                        <div class="bg-green-100 rounded-lg p-3 shadow max-w-[70%]">
                            <p class="text-sm">Saya ingin bertanya tentang lokasi masjid</p>
                            <p class="text-xs text-gray-500 text-right mt-1">10:01</p>
                        </div>
                    </div>
                </div>
    
                <!-- Template Pesan -->
                <div class="text-center my-4">
                    <button class="text-xs bg-white rounded-full px-3 py-1 shadow-sm border border-green-200 text-green-600 hover:bg-green-50 template-message">
                        Tanya Jadwal Sholat
                    </button>
                    <button class="text-xs bg-white rounded-full px-3 py-1 shadow-sm border border-green-200 text-green-600 hover:bg-green-50 template-message mx-2">
                        Infaq
                    </button>
                    <button class="text-xs bg-white rounded-full px-3 py-1 shadow-sm border border-green-200 text-green-600 hover:bg-green-50 template-message">
                        Lokasi Masjid
                    </button>
                </div>
            </div>
    
            <!-- Input Chat -->
            <div class="bg-gray-50 p-4 border-t">
                <div class="flex items-center">
                    <input 
                        type="text" 
                        placeholder="Ketik pesan..." 
                        class="flex-1 rounded-full px-4 py-2 border focus:outline-none focus:border-green-500"
                        id="messageInput"
                    >
                    <button class="ml-2 bg-green-600 text-white p-2 rounded-full w-10 h-10 flex items-center justify-center hover:bg-green-700" id="sendButton">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>
    
    <!-- WhatsApp Redirect -->
    <div class="container mx-auto px-4 py-8 text-center">
        <p class="text-gray-600 mb-2">Untuk respon lebih lanjut akan diarahkan ke:</p>
        <a 
            href="https://wa.me/6285692544491" 
            target="_blank"
            class="inline-block bg-green-600 text-white px-6 py-2 rounded-full hover:bg-green-700 transition-colors"
        >
            <i class="fab fa-whatsapp mr-2"></i>WhatsApp Official
        </a>
    </div>

    <!-- Footer -->
    <footer class="bg-green-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h4 class="text-lg font-bold mb-4">Tentang Kami</h4>
                    <p class="text-sm">Masjid Al Firdaus Kadipaten adalah tempat ibadah yang berlokasi di Kadipaten, yang tidak hanya berfungsi sebagai pusat kegiatan keagamaan, tetapi juga sebagai wadah untuk mempererat tali silaturahmi antar umat Muslim. Di YouTube resmi kami, Anda akan menemukan berbagai konten yang menginspirasi, seperti ceramah agama, kajian rutin, kegiatan sosial, dan program-program dakwah yang bertujuan untuk meningkatkan pemahaman agama serta mempererat ukhuwah Islamiyah.
                        Kami berkomitmen untuk menjadi masjid yang tidak hanya melayani ibadah ritual, tetapi juga berperan aktif dalam pemberdayaan masyarakat melalui berbagai kegiatan yang bermanfaat. Saksikan & ikuti terus video kami untuk mendapatkan informasi terkini tentang kegiatan masjid, ajakan kebaikan, serta berbagai momen penuh berkah.
                        Jangan lupa untuk berlangganan, like, & share agar lebih banyak lagi yang bisa merasakan manfaat dari konten kami. Semoga channel ini menjadi sarana bagi kita semua untuk terus mendekatkan diri kepada Allah.</p>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-sm">
                        <li><i class="fas fa-map-marker-alt mr-2"></i>Masjid Al Firdaus Kadipaten, Jawa Barat 45452</li>
                        <li><i class="fas fa-phone mr-2"></i>+62 856-9254-4491</li>
                        <li><i class="fas fa-envelope mr-2"></i>info@masjidalfirdaus.id</li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#jadwal" class="hover:text-green-300">Jadwal Sholat</a></li>
                        <li><a href="#khutbah" class="hover:text-green-300">Khutbah Jumat</a></li>
                        <li><a href="#program" class="hover:text-green-300">Program Kegiatan</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">Media Sosial</h4>
                    <div class="flex space-x-4">
                        <a href="https://www.facebook.com/share/18QW5KPHnj/" class="hover:text-green-300"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="https://www.instagram.com/masjid_alfirdaus.kadipaten" class="hover:text-green-300"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="https://youtube.com/@masjidalfirdauskadipaten" class="hover:text-green-300"><i class="fab fa-youtube fa-lg"></i></a>
                        <a href="https://wa.me/+62" class="hover:text-green-300"><i class="fab fa-whatsapp fa-lg"></i></a>
                        <a href="https://www.tiktok.com/@masjidalfirdauskadipaten" class="hover:text-green-300"><i class="fab fa-tiktok fa-lg"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-green-800 mt-8 pt-8 text-center text-sm">
                <p>&copy; 2024 Masjid Al-firdaus. All rights reserved.</p>
                <p class="mt-2">Dikembangkan dengan <i class="fas fa-heart text-red-400"></i> G-Team ~Kuman</p>
            </div>
        </div>
    </footer>

    <!-- Script JavaScript -->
    <script>
        // Fungsi untuk kirim pesan ke WhatsApp
        document.getElementById('sendButton').addEventListener('click', function() {
            const message = document.getElementById('messageInput').value;
            const phoneNumber = "6285692544491"; // Ganti dengan nomor WhatsApp yang bener
            const encodedMessage = encodeURIComponent(message);
            const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodedMessage}`;
            window.open(whatsappUrl, '_blank');
        });

        // Biar bisa enter juga buat kirim pesan
        document.getElementById('messageInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                document.getElementById('sendButton').click();
            }
        });
    </script>
</body>
</html>