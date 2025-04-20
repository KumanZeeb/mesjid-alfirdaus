<header class="bg-gradient-to-r from-green-800 to-emerald-900 text-white fixed w-full z-50 shadow-xl" x-data="header">
  <div class="container mx-auto px-4 py-4 flex justify-between items-center">
    <!-- Logo & Judul -->
    <a href="{{ route('home') }}" class="flex items-center group">
      <div class="p-1 transform group-hover:rotate-12 transition duration-300">
        <img src="{{ asset('logo.png') }}" alt="Logo Masjid Al-Firdaus" class="h-12 w-12 object-contain">
      </div>
      <div class="ml-3">
        <span class="text-xl font-bold block font-poppins">Masjid Al-Firdaus</span>
        <span class="text-sm font-light block mt-[-2px]">Kadipaten</span>
      </div>
    </a>

    <!-- Desktop Menu -->
    <nav class="hidden md:flex items-center space-x-8">
      <a href="#" class="menu-link relative group">
        <i class="fas fa-satellite-dish mr-2"></i>
        <span>Live Streaming</span>
        <div class="h-[2px] bg-white absolute bottom-0 left-0 w-0 group-hover:w-full transition-all duration-300"></div>
      </a>

      <a href="{{ route('artikel') }}" class="menu-link relative group">
        <i class="fas fa-newspaper -2"></i>
        <span>Artikel</span>
        <div class="h-[2px] bg-white absolute bottom-0 left-0 w-0 group-hover:w-full transition-all duration-300"></div>
      </a>

      <a href="{{ route('kalender') }}" class="menu-link relative group">
        <i class="fas fa-calendar mr-2"></i>
        <span>Kalender</span>
        <div class="h-[2px] bg-white absolute bottom-0 left-0 w-0 group-hover:w-full transition-all duration-300"></div>
      </a>

      <div x-data="{ isOpen: false }" class="relative">
        <!-- Tombol Kajian -->
        <button @click="isOpen = !isOpen" class="menu-link group flex items-center focus:outline-none">
          <i class="fas fa-book-open mr-2"></i>
          <span>Kajian</span>
          <i class="fas fa-chevron-down text-xs ml-1.5 transform transition-transform duration-300"
            :class="{ 'rotate-180': isOpen }"></i>
        </button>

        <!-- Dropdown Menu -->
        <div x-show="isOpen" @click.away="isOpen = false" x-transition:enter="transition ease-out duration-200"
          x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
          x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
          x-transition:leave-end="opacity-0 translate-y-1"
          class="absolute top-full mt-2 w-48 bg-white rounded-lg shadow-xl py-2 z-50">
          
          <!-- Link Kajian Harian -->
          <a href="{{ route('kajian.category', 'harian') }}" class="px-4 py-2.5 text-emerald-900 hover:bg-gray-100 flex items-center">
            <i class="fas fa-clock text-sm mr-3"></i> Harian
          </a>
          
          <!-- Link Kajian Mingguan -->
          <a href="{{ route('kajian.category', 'mingguan') }}" class="px-4 py-2.5 text-emerald-900 hover:bg-gray-100 flex items-center">
            <i class="fas fa-calendar-week text-sm mr-3"></i> Mingguan
          </a>
          
          <!-- Link Kajian Bulanan -->
          <a href="{{ route('kajian.category', 'bulanan') }}" class="px-4 py-2.5 text-emerald-900 hover:bg-gray-100 flex items-center">
            <i class="fas fa-moon text-sm mr-3"></i> Bulanan
          </a>
          
          <!-- Link Kajian Akbar -->
          <a href="{{ route('kajian.category', 'akbar') }}" class="px-4 py-2.5 text-emerald-900 hover:bg-gray-100 flex items-center">
            <i class="fas fa-microphone-alt text-sm mr-3"></i> Akbar
          </a>
        </div>
      </div>

      <a href="{{ route('infaq') }}" 
        class="ml-4 px-6 py-2.5 bg-white/20 backdrop-blur-sm rounded-full hover:bg-white/30 transition-all 
               flex items-center border border-white/10 hover:border-white/20 shadow-lg hover:shadow-xl">
        <i class="fas fa-hand-holding-heart mr-2"></i>
        <span class="font-semibold">Infaq</span>
      </a>
    </nav>

    <!-- Mobile Menu Button -->
    <div class="md:hidden">
      <button @click="toggleMobileMenu" class="text-2xl p-2 hover:text-green-300 transition-colors">
        <i class="fas fa-bars"></i>
      </button>
    </div>
  </div>

  <!-- Mobile Menu Overlay -->
  <div x-show="isMobileMenuOpen" @click.away="closeMobileMenu" x-cloak
    class="fixed inset-0 bg-black/50 z-40 md:hidden" x-transition>
    <div class="absolute right-0 top-0 h-full w-80 bg-gradient-to-b from-green-800 to-emerald-900 shadow-2xl p-6"
      @click.stop> <!-- Ini biar klik di dalam sidebar gak nutup -->
      
      <!-- Tombol Close -->
      <div class="flex justify-between items-center mb-8">
        <h3 class="text-xl font-bold">Menu</h3>
        <button @click="closeMobileMenu" class="text-2xl p-2 hover:text-green-300">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <!-- Menu Items -->
      <nav class="space-y-4">
        <a href="#" class="block p-3 rounded-lg hover:bg-white/10 transition-colors">
          <i class="fas fa-satellite-dish mr-3"></i> Live Streaming
        </a>
        <a href="{{ route('kalender') }}" class="block p-3 rounded-lg hover:bg-white/10 transition-colors">
          <i class="fas fa-calendar mr-3"></i> Kalender
        </a>
        <a href="{{ route('infaq') }}" class="block p-3 rounded-lg hover:bg-white/10 transition-colors">
          <i class="fas fa-hand-holding-heart mr-3"></i> Infaq
        </a>
        <a href="{{ route('artikel') }}" class="block p-3 rounded-lg hover:bg-white/10 transition-colors">
          <i class="fas fa-newspaper mr-3"></i> Artikel
        </a>
        
        <!-- Dropdown Kajian -->
        <div x-data="{ kajianOpen: false }" class="space-y-2">
          <button @click="kajianOpen = !kajianOpen" class="w-full p-3 rounded-lg hover:bg-white/10 text-left flex items-center justify-between">
            <span><i class="fas fa-book-open mr-3"></i> Kajian</span>
            <i class="fas fa-chevron-down text-xs transform transition-transform" :class="{ 'rotate-180': kajianOpen }"></i>
          </button>
          <div x-show="kajianOpen" class="ml-6 space-y-2">
            <a href="{{ route('kajian.category', 'harian') }}" class="block p-2 rounded-lg hover:bg-white/10">Harian</a>
            <a href="{{ route('kajian.category', 'mingguan') }}" class="block p-2 rounded-lg hover:bg-white/10">Mingguan</a>
            <a href="{{ route('kajian.category', 'bulanan') }}" class="block p-2 rounded-lg hover:bg-white/10">Bulanan</a>
            <a href="{{ route('kajian.category', 'akbar') }}" class="block p-2 rounded-lg hover:bg-white/10">Akbar</a>
          </div>
        </div>
      </nav>
    </div>
  </div>
</header>

<!-- Script Alpine.js -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<!-- Custom Script -->
<script>
  document.addEventListener('alpine:init', () => {
    Alpine.data('header', () => ({
      isMobileMenuOpen: false, // State untuk mobile menu
      isKajianOpen: false, // State untuk dropdown kajian di mobile

      // Method untuk toggle mobile menu
      toggleMobileMenu() {
        this.isMobileMenuOpen = !this.isMobileMenuOpen;
      },

      // Method untuk close mobile menu
      closeMobileMenu() {
        this.isMobileMenuOpen = false;
      },

      // Method untuk toggle dropdown kajian di mobile
      toggleKajian() {
        this.isKajianOpen = !this.isKajianOpen;
      }
    }));
  });
</script>

<!-- Style Tambahan -->
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&display=swap');

.font-poppins {
  font-family: 'Poppins', sans-serif;
}

.menu-link {
  @apply flex items-center px-3 py-2 transition-all duration-300 hover:text-green-300 text-sm font-medium;
}

.shadow-xl {
  box-shadow: 0 10px 30px -10px rgba(0,0,0,0.2);
}
</style>