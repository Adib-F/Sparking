<!-- Navbar -->
<nav class="sticky top-0 z-50 shadow-lg bg-biru_tua font-poppins">
    <div class="flex items-center justify-between px-4 py-4 mx-auto max-w-7xl">
        <!--logo dan nama-->
        <div class="flex items-center text-white">
            <img src="{{ asset('images/icon.png') }}" alt="Logo" class="w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14">
            <h1 class="pt-1 text-xl font-bold sm:text-xl md:text-2xl lg:text-3xl">PARKING</h1>
        </div>


        @guest
        <!-- Menu untuk pengguna yang belum login (landing page) -->
            <div>
                <a href="#tentang" class="px-4 text-white hover:text-blue-500">Tentang</a>
                <a href="#keunggulan" class="px-4 text-white hover:text-blue-500">Keunggulan</a>
                <a href="javascript:void(0);" onclick="openModal()" class="px-6 py-2 font-semibold text-white transition duration-300 rounded-full shadow bg-biru_muda hover:bg-white hover:text-biru_muda">Login</a>
            </div>
        @endguest

        @auth
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" @click.outside="open = false"
                class="text-blue-200 transition-colors hover:text-white focus:outline-none">
                <i class="text-3xl sm:text-3xl md:text-4xl lg:text-4xl fas fa-user-circle"></i>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open" x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="absolute right-0 z-50 w-48 py-1 mt-2 bg-white border border-gray-200 rounded-md shadow-lg">
                <a href="{{ route('settings') }}"
                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                    <i class="mr-2 text-gray-500 fas fa-cog"></i> Setting
                </a>

                <!-- Logout dengan form POST -->
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit"
                        class="flex items-center w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                        <i class="mr-2 text-gray-500 fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
        @endauth
    </div>
</nav>
