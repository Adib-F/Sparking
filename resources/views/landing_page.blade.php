@extends('layout.mainUser')

@include('component/header')

@section('main')
    @include('component.auth.modal_login_regis')

    <section class="relative h-[calc(100vh-4rem)]">
        <!-- Hero Section (hanya satu) -->
        <div class="absolute inset-0 z-10 flex flex-col items-center justify-center px-4 text-center text-white bg-black/40">
            <h5 class="mb-2 text-3xl font-bold md:text-5xl font-poppins">
                SELAMAT DATANG DI HALAMAN WEB
            </h5>
            <h1 class="text-6xl text-blue-800 font-londrina drop-shadow-lg">SPARKING</h1>
            <p class="mt-2 text-base md:text-lg font-poppins">
                Layanan online parkir yang mempermudah hari anda
            </p>
        </div>

        <!-- Slider Images -->
        <div id="slider" class="flex h-full transition-transform duration-700 ease-in-out">
            <img src="img/Gedung.jpg" class="flex-shrink-0 object-cover w-full" alt="Gedung" />
            {{-- <img src="img/techno.jpg" class="flex-shrink-0 object-cover w-full" alt="Techno" />
            <img src="img/keunggulan.png" class="flex-shrink-0 object-cover w-full" alt="Keunggulan" /> --}}
        </div>
    </section>

    <!-- Konten lainnya tetap sama -->
    @include('component.success-error')
    @include('component.lending_page.animasi_tiga_gambar')
    @include('component.lending_page.tentang_kami')
    @include('component.lending_page.keunggulan')
    @include('component/footerUser')
@endsection
