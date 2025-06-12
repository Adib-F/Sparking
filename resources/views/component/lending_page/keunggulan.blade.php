<!-- Keunggulan -->
<section id="keunggulan" class="py-12 bg-gray-50 font-poppins sm:py-16 lg:py-20">
    <div class="container px-6 mx-auto max-w-7xl">
        <!-- Bagian Utama - Gambar tetap di kanan -->
        <div class="flex flex-col-reverse items-center gap-8 lg:flex-row">
            <!-- Konten (Kiri) -->
            <div class="w-full lg:w-1/2">
                <div class="max-w-lg p-6 mx-auto lg:ml-0 lg:mr-auto lg:p-8">
                    <h2 class="mb-6 text-3xl font-bold text-gray-900 sm:text-4xl">Keunggulan <span class="text-blue-600">SPARKING</span></h2>

                    <ul class="space-y-4 text-gray-700">
                        <li class="flex items-start">
                            <svg class="flex-shrink-0 w-5 h-5 mt-1 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-base font-medium sm:text-lg">Integrasi real-time dengan sensor parkir IoT</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="flex-shrink-0 w-5 h-5 mt-1 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-base font-medium sm:text-lg">Antarmuka responsif untuk semua perangkat</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="flex-shrink-0 w-5 h-5 mt-1 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-base font-medium sm:text-lg">Proses otomatis dengan sistem pintar</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="flex-shrink-0 w-5 h-5 mt-1 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-base font-medium sm:text-lg">Laporan parkir lengkap dan terstruktur</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="flex-shrink-0 w-5 h-5 mt-1 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-base font-medium sm:text-lg">Desain antarmuka modern dan intuitif</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Gambar (Kanan) -->
            <div class="w-full lg:w-1/2">
                <div class="relative h-64 overflow-hidden rounded-lg shadow-lg sm:h-80 lg:h-[500px]">
                    <img src="{{ asset('img/aboutme.jpg') }}"
                         alt="Sistem Parkir Polibatam"
                         class="object-cover w-full h-full transition duration-500 hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-l from-white/30 to-transparent"></div>
                </div>
            </div>
        </div>

        <!-- Manfaat -->
        <div class="grid grid-cols-1 gap-6 mt-16 sm:grid-cols-2 lg:grid-cols-4 sm:gap-8">
            <!-- Manfaat 1 -->
            <div class="p-6 transition-all bg-white rounded-xl hover:shadow-md">
                <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 bg-blue-100 rounded-full sm:w-16 sm:h-16">
                    <svg class="w-6 h-6 text-blue-600 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="mb-2 text-lg font-semibold text-center text-gray-800 sm:text-xl">Efisiensi Waktu</h3>
                <p class="text-sm text-center text-gray-600 sm:text-base">Mempercepat proses pencarian slot parkir hingga 70% lebih cepat</p>
            </div>

            <!-- Manfaat 2 -->
            <div class="p-6 transition-all bg-white rounded-xl hover:shadow-md">
                <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 bg-blue-100 rounded-full sm:w-16 sm:h-16">
                    <svg class="w-6 h-6 text-blue-600 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="mb-2 text-lg font-semibold text-center text-gray-800 sm:text-xl">Keamanan</h3>
                <p class="text-sm text-center text-gray-600 sm:text-base">Sistem pemantauan terintegrasi meningkatkan keamanan kendaraan</p>
            </div>

            <!-- Manfaat 3 -->
            <div class="p-6 transition-all bg-white rounded-xl hover:shadow-md">
                <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 bg-blue-100 rounded-full sm:w-16 sm:h-16">
                    <svg class="w-6 h-6 text-blue-600 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="mb-2 text-lg font-semibold text-center text-gray-800 sm:text-xl">Penghematan</h3>
                <p class="text-sm text-center text-gray-600 sm:text-base">Mengurangi waktu idle kendaraan yang berdampak pada penghematan BBM</p>
            </div>

            <!-- Manfaat 4 -->
            <div class="p-6 transition-all bg-white rounded-xl hover:shadow-md">
                <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 bg-blue-100 rounded-full sm:w-16 sm:h-16">
                    <svg class="w-6 h-6 text-blue-600 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="mb-2 text-lg font-semibold text-center text-gray-800 sm:text-xl">Data Akurat</h3>
                <p class="text-sm text-center text-gray-600 sm:text-base">Laporan parkir digital yang akurat untuk manajemen kampus</p>
            </div>
        </div>
    </div>
</section>
