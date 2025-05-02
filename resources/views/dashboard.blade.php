@extends('layout.mainUser')

@include('component/headerUser')

@section('main')
    <main class="container px-4 py-6 pb-10 mx-auto content-wrapper">

        <div class="mb-6 overflow-hidden bg-white rounded-lg shadow-lg md:mb-8">
            <div class="relative h-72 carousel-container">
                <div class="carousel-slide">
                    <img alt="Modern parking facility" class="object-cover w-full h-auto md:h-72"
                        src="{{ asset('img/techno.jpg') }}" />
                    <img alt="Smart parking system interface" class="object-cover w-full h-auto md:h-72"
                        src="{{ asset('img/Gedung.jpg') }}" />
                    <img alt="Aerial view of parking" class="object-cover w-full h-auto md:h-72"
                        src="{{ asset('img/cover.jpg') }}" />
                </div>

                <div class="absolute left-0 right-0 flex justify-center bottom-4">
                    <div class="w-2 h-2 mx-1 bg-white bg-opacity-50 rounded-full carousel-dot"></div>
                    <div class="w-2 h-2 mx-1 bg-white bg-opacity-50 rounded-full carousel-dot"></div>
                    <div class="w-2 h-2 mx-1 bg-white bg-opacity-50 rounded-full carousel-dot"></div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-2 mb-6 md:grid-cols-3 md:gap-8 md:mb-8">
            <a href="{{ route('real-time') }}">
                <div id="realTimeCard"
                    class="flex flex-col items-center p-3 transition-transform duration-300 transform bg-white rounded-lg shadow-lg cursor-pointer md:p-6 hover:scale-105">
                    <i class="mb-2 text-2xl text-blue-500 fas fa-car md:text-4xl md:mb-4"></i>
                    <p class="text-sm font-bold md:text-xl">Real-Time</p>
                    <p class="hidden mt-1 text-xs text-center md:text-base md:mt-2 md:block">Monitor parkir secara real-time
                    </p>
                </div>
            </a>
            <a href="{{ route('qr-code') }}">
                <div id="qrCodeCard"
                    class="flex flex-col items-center p-3 transition-transform duration-300 transform bg-white rounded-lg shadow-lg cursor-pointer md:p-6 hover:scale-105">
                    <i class="mb-2 text-2xl text-blue-500 fas fa-qrcode md:text-4xl md:mb-4"></i>
                    <p class="text-sm font-bold md:text-xl">QR-Code</p>
                    <p class="hidden mt-1 text-xs text-center md:text-base md:mt-2 md:block">Akses mudah dengan QR Code</p>
                </div>
            </a>
            <a href="{{ route('analysis') }}">
                <div id="analysisCard"
                    class="flex flex-col items-center p-3 transition-transform duration-300 transform bg-white rounded-lg shadow-lg cursor-pointer md:p-6 hover:scale-105">
                    <i class="mb-2 text-2xl text-blue-500 fas fa-chart-line md:text-4xl md:mb-4"></i>
                    <p class="text-sm font-bold md:text-xl">Analisis</p>
                    <p class="hidden mt-1 text-xs text-center md:text-base md:mt-2 md:block">Analisis penggunaan parkir</p>
                </div>
            </a>
        </div>
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <h2 class="mb-4 text-lg font-bold text-center">Data Diri & Kendaraan Pengguna</h2>
            <hr class="w-2/3 mx-auto mb-4 border-t-2 border-gray-200">

            <div class="flex items-start space-x-8">

                <div class="relative">
                    <div class="w-32 h-32 overflow-hidden rounded-full shadow-lg ring-4 ring-blue-100">
                        <img alt="Profile picture of the user" src="{{ Storage::url(auth()->user()->foto_pengguna) }}"
                            class="object-cover w-full h-full">
                    </div>
                </div>


                <div class="flex-1 space-y-4">

                    <div class="pb-2 border-b">
                        <h3 class="text-base font-semibold text-gray-800 uppercase">{{ auth()->user()->nama }}</h3>
                        <p class="text-sm text-gray-500">Pengguna sejak {{ date('Y') }}</p>
                    </div>


                    <div class="grid grid-cols-1 gap-3">

                        <div class="flex items-center space-x-2">
                            <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50">
                                <i class="w-4 h-4 text-green-500 fas fa-id-card"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">NIM/NIK/NIDN</p>
                                <p class="font-medium text-gray-800">{{ auth()->user()->identitas }}</p>
                            </div>
                        </div>


                        <div class="flex items-center space-x-2">
                            <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50">
                                <i class="w-4 h-4 text-purple-600 fas fa-list"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Jenis Pengguna</p>
                                <p class="font-medium text-gray-800">{{ auth()->user()->jenis_pengguna }}</p>
                            </div>
                        </div>


                        <div class="flex items-center space-x-2">
                            <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-purple-50">
                                <i class="w-4 h-4 text-orange-300 fas fa-envelope"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Email</p>
                                <p class="font-medium text-gray-800">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-purple-50">
                                <i class="w-4 h-4 text-blue-300 fas fa-phone"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Nomor Telepon</p>
                                <p class="font-medium text-gray-800">{{ auth()->user()->nomor_telepon }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        const profileDropdown = document.getElementById('profileDropdown');
        const dropdownMenu = document.getElementById('dropdownMenu');
        profileDropdown.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });
        window.addEventListener('click', (event) => {
            if (!profileDropdown.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });

        // Auto-sliding carousel
        const carouselSlide = document.querySelector('.carousel-slide');
        const carouselImages = document.querySelectorAll('.carousel-slide img');
        const carouselDots = document.querySelectorAll('.carousel-dot');
        let counter = 0;
        const size = carouselImages[0].clientWidth;

        function slideImage() {
            if (counter >= carouselImages.length - 1) {
                counter = 0;
            } else {
                counter++;
            }
            carouselSlide.style.transform = 'translateX(' + (-size * counter) + 'px)';
            updateDots();
        }

        function updateDots() {
            carouselDots.forEach((dot, index) => {
                if (index === counter) {
                    dot.classList.add('bg-white');
                    dot.classList.remove('bg-opacity-50');
                } else {
                    dot.classList.add('bg-opacity-50');
                    // dot.classList.remove('bg-white');
                }
            });
        }
        setInterval(slideImage, 5000); // ganti gambar setiap 5 detik

        updateDots();
    </script>

@endsection
