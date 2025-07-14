@extends('layout.mainUser')

@include('component/header')

@section('main')
    @include('component.auth.modal_login_regis')

    <section class="relative h-[calc(100vh-4rem)]">
        <!-- Overlay -->
        <div class="absolute inset-0 z-10 bg-gradient-to-b from-black/70 via-black/60 to-black/40"></div>

        <!-- Hero Content -->
        <div class="absolute inset-0 z-10 flex flex-col items-center justify-center px-4 text-center text-white">
            <h5 class="mb-2 text-3xl font-bold md:text-5xl font-poppins drop-shadow-[2px_2px_4px_rgba(0,0,0,0.7)]">
                SELAMAT DATANG DI HALAMAN WEB
            </h5>
            <h1 class="text-6xl text-blue-400 font-londrina drop-shadow-[3px_3px_5px_rgba(0,0,0,0.8)]">SPARKING</h1>
            <p class="mt-2 text-base md:text-lg font-poppins drop-shadow-[1px_1px_3px_rgba(0,0,0,0.7)]">
                Layanan online parkir yang mempermudah hari anda
            </p>
        </div>

        <!-- Slider Background -->
        <div id="slider" class="flex h-full transition-transform duration-700 ease-in-out">
            <img src="{{ asset('img/Gedung.jpg') }}" class="flex-shrink-0 object-cover w-full h-full" alt="Gedung" />
        </div>
    </section>


    <!-- Konten lainnya tetap sama -->
    @include('component.success-error')
    @include('component.lending_page.animasi_tiga_gambar')
    @include('component.lending_page.tentang_kami')
    @include('component.lending_page.keunggulan')
    @include('component/footerUser')
@endsection
