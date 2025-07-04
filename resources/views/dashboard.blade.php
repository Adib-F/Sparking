@extends('layout.mainUser')

@include('component.headerUser')

@section('main')
<div class="min-h-[calc(100vh-80px)] bg-gradient-to-br from-blue-50 to-indigo-100 p-4 md:p-8 flex items-center justify-center transition-colors duration-300">
    <div class="w-full max-w-4xl mx-auto">

        <div class="mb-12 overflow-hidden shadow-2xl rounded-2xl">
            <div class="h-48 swiper md:h-72">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="relative w-full h-full">
                            <img src="{{ asset('/images/carousel1.jpg') }}" alt="Gambar Dashboard 1"
                                class="object-cover w-full h-full transition-all duration-500 hover:scale-105">
                            <div class="absolute inset-0 flex items-end p-6 bg-gradient-to-t from-black/50 to-transparent">
                                <h3 class="text-xl font-bold text-white">Area Parkir</h3>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="relative w-full h-full">
                            <img src="{{ asset('data_parkir/subzona/2.1.jpg') }}" alt="Gambar Dashboard 2"
                                class="object-cover w-full h-full transition-all duration-500 hover:scale-105">
                            <div class="absolute inset-0 flex items-end p-6 bg-gradient-to-t from-black/50 to-transparent">
                                <h3 class="text-xl font-bold text-white">Sub Zona Parkir 2.1</h3>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="relative w-full h-full">
                            <img src="{{ asset('data_parkir/subzona/1.1.jpg') }}" alt="Gambar Dashboard 3"
                                class="object-cover w-full h-full transition-all duration-500 hover:scale-105">
                            <div class="absolute inset-0 flex items-end p-6 bg-gradient-to-t from-black/50 to-transparent">
                                <h3 class="text-xl font-bold text-white">Sub Zona Parkir 1.1</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-10 text-center animate-fade-in">
            <h1 class="mb-2 text-3xl font-bold text-gray-800 md:text-4xl">Selamat Datang di SPARKING</h1>
            <p class="max-w-2xl mx-auto text-lg text-gray-600">Sistem Informasi Parkir Pintar Politeknik Negeri Batam</p>
        </div>

        <div class="grid max-w-4xl grid-cols-1 gap-20 mx-auto mb-12 md:grid-cols-2 md:max-w-2xl">
            <a href="{{ route('real-time') }}"
               class="overflow-hidden transition-all duration-300 duration-500 ease-out transform translate-y-10 bg-white shadow-lg opacity-0 group rounded-xl hover:shadow-xl hover:-translate-y-1"
               id="realtime-card">
                <div class="flex flex-col items-center p-6 text-center">
                    <div class="flex items-center justify-center w-16 h-16 mb-4 transition-colors bg-blue-100 rounded-full group-hover:bg-blue-200">
                        <i class="text-2xl text-blue-600 fas fa-tachometer-alt"></i>
                    </div>
                    <h3 class="mb-2 text-xl font-semibold text-gray-800">Real-Time Monitoring</h3>
                    <p class="text-sm text-gray-500">Pantau ketersediaan slot parkir secara real-time</p>
                </div>
            </a>

            <a href="{{ route('statistik') }}"
               class="overflow-hidden transition-all duration-300 duration-500 ease-out delay-150 transform translate-y-10 bg-white shadow-lg opacity-0 group rounded-xl hover:shadow-xl hover:-translate-y-1"
               id="analysis-card">
                <div class="flex flex-col items-center p-6 text-center">
                    <div class="flex items-center justify-center w-16 h-16 mb-4 transition-colors bg-indigo-100 rounded-full group-hover:bg-indigo-200">
                        <i class="text-2xl text-indigo-600 fas fa-chart-bar"></i>
                    </div>
                    <h3 class="mb-2 text-xl font-semibold text-gray-800">Analisis Data</h3>
                    <p class="text-sm text-gray-500">Statistik dan analisis penggunaan parkir</p>
                </div>
            </a>
        </div>

    </div>
</div>

<script src="{{ asset('js/dashboard_user.js') }}"></script>
<script src="{{ asset('css_user/dashboard_user.css') }}"></script>


@endsection
