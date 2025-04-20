<!-- resources/views/partials/hero.blade.php -->
<section class="bg-[url('https://images.unsplash.com/photo-1587617425953-9075d28b8c46')] bg-cover bg-center mt-[280px] pt-[200px]">
  <div class="bg-black/60 py-16 mt-8">
    <div class="container mx-auto px-4 text-center text-white">
      <h2 class="text-4xl font-bold mb-4">Selamat Datang di Masjid Al-Firdaus</h2>
      <div class="grid grid-cols-2 md:grid-cols-5 gap-4 max-w-4xl mx-auto" id="livePrayerTimes"></div>
      <div class="mt-8">
        <p class="text-xl">
          Waktu Sholat Berikutnya:
          <span id="nextPrayer" class="font-bold"></span>
          dalam <span id="countdown" class="text-green-400"></span>
        </p>
      </div>
    </div>
  </div>
</section>

    <script>
        // Fungsi Jadwal Sholat & Countdown
        let prayerInterval;
        async function updatePrayerTimes() {
            try {
                const response = await fetch('https://api.aladhan.com/v1/timingsByCity?city=Majalengka&country=Indonesia&method=2');
                const data = await response.json();
                const timings = data.data.timings;
    
                const prayers = [
                    { name: 'Subuh', time: timings.Fajr },
                    { name: 'Dzuhur', time: timings.Dhuhr },
                    { name: 'Ashar', time: timings.Asr },
                    { name: 'Maghrib', time: timings.Maghrib },
                    { name: 'Isya', time: timings.Isha }
                ];
    
                const container = document.getElementById('livePrayerTimes');
                container.innerHTML = prayers.map(prayer => `
                    <div class="bg-white/10 p-4 rounded-lg backdrop-blur-sm">
                        <p class="font-bold">${prayer.name}</p>
                        <p class="text-2xl">${prayer.time.split(' ')[0]}</p>
                    </div>
                `).join('');
    
                // Fungsi update countdown
                function updateCountdown() {
                    const now = new Date();
                    let nextPrayer = null;
                    
                    // Cari waktu sholat berikutnya
                    for(const prayer of prayers) {
                        const [hours, minutes] = prayer.time.split(' ')[0].split(':');
                        const prayerTime = new Date();
                        prayerTime.setHours(hours, minutes, 0);
                        
                        if(prayerTime > now) {
                            nextPrayer = { ...prayer, time: prayerTime };
                            break;
                        }
                    }
    
                    // Jika semua waktu sholat hari ini sudah lewat, ambil subuh besok
                    if(!nextPrayer) {
                        const [hours, minutes] = prayers[0].time.split(' ')[0].split(':');
                        const tomorrow = new Date();
                        tomorrow.setDate(tomorrow.getDate() + 1);
                        tomorrow.setHours(hours, minutes, 0);
                        nextPrayer = { ...prayers[0], time: tomorrow };
                    }
    
                    const diff = nextPrayer.time - now;
                    
                    if(diff > 0) {
                        const hours = Math.floor(diff / (1000 * 60 * 60));
                        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                        document.getElementById('countdown').innerHTML = 
                            `<span class="text-green-400">${hours} jam ${minutes} menit</span>`;
                        document.getElementById('nextPrayer').textContent = nextPrayer.name;
                    } else {
                        // Jika waktu sholat tiba
                        document.getElementById('countdown').innerHTML = 
                            `<span class="text-red-400 animate-pulse">SUDAH WAKTUNYA SHOLAT ${nextPrayer.name.toUpperCase()}!</span>`;
                        document.getElementById('nextPrayer').textContent = "Memuat sholat berikutnya...";
                        
                        // Refresh countdown setelah 10 detik
                        setTimeout(() => {
                            clearInterval(prayerInterval);
                            updatePrayerTimes();
                        }, 10000);
                    }
                }
    
                // Jalankan update countdown setiap detik
                clearInterval(prayerInterval);
                prayerInterval = setInterval(updateCountdown, 1000);
                updateCountdown(); // Panggil pertama kali
    
            } catch (error) {
                console.error('Error:', error);
            }
        }
    
        // Inisialisasi
        window.onload = () => {
            updatePrayerTimes();
            // Update jadwal setiap 1 jam
            setInterval(updatePrayerTimes, 3600000);
        }
    </script>