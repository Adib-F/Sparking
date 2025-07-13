<!-- Navbar -->
<nav class="sticky top-0 z-50 shadow-lg bg-biru_tua font-poppins">
    <div class="flex items-center justify-between px-4 py-4 mx-auto max-w-7xl">
        <!-- Logo -->
        <div class="flex items-center text-white">
            <img src="{{ asset('images/icon.png') }}" alt="Logo" class="w-12 h-12">
            <h1 class="pt-1 text-2xl font-bold ">PARKING</h1>
        </div>



        <!-- Hamburger menu button (mobile) -->
        <div class="md:hidden">
            <button id="menu-button" class="text-white focus:outline-none" onclick="toggleMenu()">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Menu Links (desktop) -->
        <div class="hidden md:flex md:items-center md:space-x-6">
            <a href="#tentang" class="text-white transition hover:text-blue-400">Tentang</a>
            <a href="#keunggulan" class="text-white transition hover:text-blue-400">Keunggulan</a>
            <a href="{{ route('realtime-public') }}" class="text-white transition hover:text-blue-400">Real-time</a>
            <a href="javascript:void(0);" onclick="openModal()"
                class="px-6 py-2 font-semibold text-white transition duration-300 rounded-full shadow bg-biru_muda hover:bg-white hover:text-biru_muda">
                Login
            </a>
        </div>
    </div>

    <!-- Mobile Menu (hidden by default) -->
    <div id="mobile-menu" class="hidden px-4 pb-4 md:hidden">
        <a href="#tentang" class="block py-2 text-white hover:text-blue-400">Tentang</a>
        <a href="#keunggulan" class="block py-2 text-white hover:text-blue-400">Keunggulan</a>
        <a href="javascript:void(0);" onclick="openModal()"
            class="block px-6 py-2 mt-2 font-semibold text-center text-white transition duration-300 rounded-full shadow bg-biru_muda hover:bg-white hover:text-biru_muda">
            Login
        </a>
    </div>
</nav>

<script>
    function toggleMenu() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    }
</script>
