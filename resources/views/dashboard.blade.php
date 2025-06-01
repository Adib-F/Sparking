@extends('layout.mainUser')

@include('component.headerUser')

@section('main')
<div class="min-h-[calc(100vh-80px)] bg-gradient-to-br from-blue-50 to-indigo-100 p-4 md:p-8 flex items-center justify-center transition-colors duration-300">
    <div class="w-full max-w-4xl mx-auto">

        <div class="mb-12 rounded-2xl overflow-hidden shadow-2xl">
            <div class="swiper h-48 md:h-72">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="relative h-full w-full">
                            <img src="{{ asset('images/carousel.png') }}" alt="Gambar Dashboard 1"
                                class="object-cover w-full h-full transition-all duration-500 hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent flex items-end p-6">
                                <h3 class="text-white text-xl font-bold">Area Parkir Kampus</h3>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="relative h-full w-full">
                            <img src="{{ asset('foto parkir/zona 5/IMG-20240920-WA0010.jpg') }}" alt="Gambar Dashboard 2"
                                class="object-cover w-full h-full transition-all duration-500 hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent flex items-end p-6">
                                <h3 class="text-white text-xl font-bold">Zona Parkir 5</h3>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="relative h-full w-full">
                            <img src="{{ asset('foto parkir/zona 5/IMG-20240920-WA0009.jpg') }}" alt="Gambar Dashboard 3"
                                class="object-cover w-full h-full transition-all duration-500 hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent flex items-end p-6">
                                <h3 class="text-white text-xl font-bold">Denah Parkir</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mb-10 animate-fade-in">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">Selamat Datang di SPARKING</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Sistem Informasi Parkir Pintar Politeknik Negeri Batam</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-20 max-w-4xl md:max-w-2xl mx-auto mb-12">
            <a href="{{ route('real-time') }}"
               class="group bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1 transform translate-y-10 opacity-0 transition-all duration-500 ease-out"
               id="realtime-card">
                <div class="p-6 flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-4 group-hover:bg-blue-200 transition-colors">
                        <i class="fas fa-tachometer-alt text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Real-Time Monitoring</h3>
                    <p class="text-gray-500 text-sm">Pantau ketersediaan slot parkir secara real-time</p>
                </div>
            </a>

            <a href="{{ route('statistik') }}"
               class="group bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1 transform translate-y-10 opacity-0 transition-all duration-500 ease-out delay-150"
               id="analysis-card">
                <div class="p-6 flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mb-4 group-hover:bg-indigo-200 transition-colors">
                        <i class="fas fa-chart-bar text-indigo-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Analisis Data</h3>
                    <p class="text-gray-500 text-sm">Statistik dan analisis penggunaan parkir</p>
                </div>
            </a>
        </div>

    </div>
</div>

<script src="{{ asset('js/dashboard_user.js') }}"></script>
<script src="{{ asset('css_user/dashboard_user.css') }}"></script>


@endsection
