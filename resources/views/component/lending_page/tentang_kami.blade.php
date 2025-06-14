<section id="tentang" class="relative px-6 py-16 overflow-hidden bg-white font-poppins">
    <div class="flex flex-col items-center max-w-6xl gap-8 mx-auto lg:flex-row">
        <!-- Kiri: Gambar dengan Triangle Effect -->
        <div class="relative w-full h-[200px] sm:h-[300px] md:h-[400px] lg:w-1/2 lg:h-[500px]">
            <img src="{{ asset('img/mobil1.jpeg') }}" alt="Smart Parking System"
                class="object-cover w-full h-full shadow-lg rounded-xl" />

            <!-- Triangle Overlay Effect -->
            <div
                class="absolute top-0 left-0 w-full h-full bg-gradient-to-r from-white via-white/80 to-transparent mix-blend-overlay">
            </div>
            <div class="absolute top-0 left-0 w-1/2 h-full"
                style="clip-path: polygon(0 0, 80% 0, 30% 100%, 0% 100%); background: white; opacity: 0.9;"></div>
        </div>


        <!-- Kanan: Konten -->
        <div class="w-full lg:w-1/2">
            <div class="p-6 lg:p-8">
                <h2 class="mb-6 text-4xl font-bold text-gray-900 md:text-5xl">Tentang <span
                        class="text-blue-600">SPARKING</span></h2>
                <p class="mb-4 text-lg leading-relaxed text-gray-600">
                    Smart Parking Sitem (SPARKING) adalah inovasi mahasiswa Teknik Informatika Polibatam yang
                    mengintegrasikan teknologi IoT untuk manajemen parkir kampus Politeknik Negeri Batam.
                </p>
                <p class="mb-6 leading-relaxed text-gray-600">
                    Sejak <span class="font-semibold text-blue-600">Januari 2024</span>, kami mengembangkan solusi
                    parkir cerdas dengan fitur real-time monitoring dan analisis data parkir.
                </p>
                <ul class="space-y-3 text-gray-700">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 mt-1 mr-2 text-blue-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <span>Sensor pintar untuk deteksi kendaraan real-time</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 mt-1 mr-2 text-blue-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <span>Dashboard monitoring kapasitas parkir</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 mt-1 mr-2 text-blue-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <span>Proyek bimbingan Ibu Mirathul Khusna Mufida, PhD.</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 mt-1 mr-2 text-blue-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <span>Durasi pengembangan: 6 bulan</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Galeri Parkir -->
    <div class="max-w-6xl px-4 mx-auto mt-16">
        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-5">
            <div class="overflow-hidden transition-shadow rounded-lg shadow-md hover:shadow-xl">
                <img src="{{ asset('img/gambar3.png') }}" alt="Parking Sensor"
                    class="object-cover w-full h-32 transition-transform hover:scale-110">
            </div>
            <div class="overflow-hidden transition-shadow rounded-lg shadow-md hover:shadow-xl">
                <img src="{{ asset('img/gambar2.png') }}" alt="IoT Technology"
                    class="object-cover w-full h-32 transition-transform hover:scale-110">
            </div>
            <div class="overflow-hidden transition-shadow rounded-lg shadow-md hover:shadow-xl">
                <img src="{{ asset('img/gambar1.png') }}" alt="Parking Lot"
                    class="object-cover w-full h-32 transition-transform hover:scale-110">
            </div>
            <div class="overflow-hidden transition-shadow rounded-lg shadow-md hover:shadow-xl">
                <img src="{{ asset('img/gambar4.jpeg') }}" alt="Data Dashboard"
                    class="object-cover w-full h-32 transition-transform hover:scale-110">
            </div>
            <div class="overflow-hidden transition-shadow rounded-lg shadow-md hover:shadow-xl">
                <img src="{{ asset('img/gambar5.jpeg') }}" alt="Coding Session"
                    class="object-cover w-full h-32 transition-transform hover:scale-110">
            </div>
        </div>
    </div>
</section>
