<nav class="relative z-50 p-2 text-white bg-gradient-to-r from-blue-700 to-cyan-500">
    <div class="container flex items-center justify-between mx-auto">
        <h1 id="greeting" class="pl-2 text-base font-bold leading-loose">Hallo, Selamat Datang</h1>
        <div class="relative">
            <div class="flex items-center cursor-pointer" id="profileDropdown" onclick="toggleDropdown()">
                <span class="mr-2 text-lg leading-loose block truncate max-w-[120px] sm:max-w-none"
                    title="{{ auth()->user()->nama }}">
                    {{ auth()->user()->nama }}
                </span>
                <div class="flex items-center justify-center w-10 bg-gray-300 rounded-full">
                    <img src="{{ Storage::url(auth()->user()->foto_pengguna) }}" alt="Profile Picture"
                        class="object-cover w-full h-full rounded-full">
                </div>
            </div>
            <div id="dropdownMenu"
                class="absolute right-0 z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow-lg dark:bg-gray-800 dark:divide-gray-600">
                <ul class="py-4 text-sm text-gray-700 dark:text-gray-200">
                    <li>
                        <a href="{{ route('ubah-sandi') }}"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                            Setting
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('ubah-sandi') }}"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                            Change Password
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit"
                                class="block w-full px-4 py-2 text-left hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                                Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

        <!-- Navbar -->
        {{-- <nav class="bg-biru_tua shadow-lg font-poppins sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <img src="images/icon.png" alt="Logo" class="w-10 h-10 border-2 border-white rounded-full object-cover" />
                    <div class="text-xl font-bold text-white">SIPPP</div>
                </div>

                <div>
                    <a href="#tentang" class="text-white hover:text-blue-500 px-4">Tentang</a>
                    <a href="#keunggulan" class="text-white hover:text-blue-500 px-4">Keunggulan</a>
                    <a href="javascript:void(0);" onclick="openModal()" class="bg-biru_muda hover:bg-white hover:text-biru_muda text-white font-semibold px-6 py-2 rounded-full transition duration-300 shadow">Login</a>
                </div>
            </div>
        </nav> --}}

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const greetingElement = document.getElementById("greeting");
        const currentHour = new Date().getHours();

        let greetingText = "Hallo, ";
        if (currentHour >= 5 && currentHour < 12) {
            greetingText += "Selamat Pagi";
        } else if (currentHour >= 12 && currentHour < 18) {
            greetingText += "Selamat Siang";
        } else if (currentHour >= 18 && currentHour <= 23) {
            greetingText += "Selamat Malam";
        } else {
            greetingText += "Selamat Dini Hari";
        }

        greetingElement.textContent = greetingText;
    });
</script>
