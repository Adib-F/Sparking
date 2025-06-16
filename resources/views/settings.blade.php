@extends('layout.mainUser')

@include('component/headerUser')

@section('main')
<div class="min-h-[calc(100vh-80px)] bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center p-4">
    <div class="flex flex-col items-center gap-6 w-full max-w-4xl">
        <div class="w-full flex justify-start">
            <a href="{{ route('dashboard') }}"
                class="inline-flex items-center bg-white hover:bg-gray-50 border border-gray-200 text-gray-700 px-4 py-2 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-x-0.5">
                <i class="mr-2 text-gray-500 fas fa-arrow-left"></i>Kembali
            </a>
        </div>

        <div class="bg-white shadow-xl rounded-2xl w-full max-w-4xl overflow-hidden transition-all duration-300 hover:shadow-2xl">
            <div class="px-6 pt-6">
                <div class="relative h-48 overflow-visible">
                    <img src="{{ asset('images/bg_pengaturan.jpg    ') }}" alt="Cover" class="w-full h-full object-cover rounded-xl object-center">
                    <div class="absolute left-1/2 transform -translate-x-1/2 -bottom-12 z-10">
                        <div class="relative group">
                            <img src="{{ asset('storage/'. $user->foto_pengguna) }}" alt="Profile" class="h-24 w-24 rounded-full border-4 border-white object-cover shadow-lg transition-all duration-300 group-hover:ring-4 group-hover:ring-blue-200">
                            <div class="absolute inset-0 bg-blue-500 bg-opacity-30 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="p-6 pt-16">
                <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl p-6 shadow-inner">
                    <div class="flex flex-col lg:flex-row gap-8 items-center">
                        <div class="w-full lg:w-1/3 flex justify-center">
                            <div class="group w-full max-w-xs cursor-pointer" onclick="openImageModal('{{ asset('storage/'. $user->foto_kendaraan) }}')">
                                <div class="relative w-full transition-transform duration-300 group-hover:scale-105">
                                    <img src="{{ asset('storage/'. $user->foto_kendaraan) }}" alt="Car Photo"
                                        class="w-full h-auto max-h-48 object-contain rounded-lg shadow-md">
                                    <div class="absolute inset-0 bg-black bg-opacity-20 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                        <span class="text-white font-medium bg-black bg-opacity-50 px-3 py-1 rounded-full">Lihat Ukuran Penuh</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-1 text-center lg:text-left space-y-4">
                            <div>
                                <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ $user->nama }}</h2>
                                <div class="space-y-3">
                                    <div class="flex items-center justify-center lg:justify-start space-x-3 p-2 bg-white hover:bg-white/90 rounded-lg transition-all duration-300 shadow-sm hover:shadow-md">
                                        <span class="material-icons text-indigo-500 text-[24px]">mail</span>
                                        <span class="text-gray-700 break-all">{{ $user->email }}</span>
                                    </div>

                                    <div class="flex items-center justify-center lg:justify-start space-x-3 p-2 bg-white hover:bg-white/90 rounded-lg transition-all duration-300 shadow-sm hover:shadow-md">
                                        <span class="material-icons text-indigo-500 text-[24px]">person</span>
                                        <span class="text-gray-700 capitalize">{{ $user->jenis_pengguna }}</span>
                                    </div>

                                    <div class="flex items-center justify-center lg:justify-start space-x-3 p-2 bg-white hover:bg-white/90 rounded-lg transition-all duration-300 shadow-sm hover:shadow-md">
                                        @if ($user->jenis_kendaraan === 'motor')
                                            <span class="material-icons text-indigo-500 text-[24px]">two_wheeler</span>
                                        @else
                                            <span class="material-icons text-indigo-500 text-[24px]">directions_car</span>
                                        @endif
                                        <span class="text-gray-700 capitalize">{{ $user->jenis_kendaraan }}</span>
                                    </div>

                                    <div class="flex items-center justify-center lg:justify-start space-x-3 p-2 bg-white hover:bg-white/90 rounded-lg transition-all duration-300 shadow-sm hover:shadow-md">
                                        <span class="material-icons text-indigo-500 text-[24px]">credit_card</span>
                                        <span class="text-gray-700 font-mono uppercase tracking-wider">{{ $user->no_plat }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-3 pt-2">
                                <button onclick="openPasswordResetModal()" class="flex items-center justify-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow-md transition-all duration-300 transform hover:-translate-y-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    <span>Ubah Kata Sandi</span>
                                </button>
                                <button onclick="openVehiclePhotoModal()" class="flex items-center justify-center space-x-2 bg-white hover:bg-gray-100 border border-gray-200 text-gray-800 px-5 py-2 rounded-lg shadow-md transition-all duration-300 transform hover:-translate-y-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>Ubah Foto Kendaraan</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@include('component.success-error')
@include('component.pengaturan.perbesar_gambar')
@include('component.pengaturan.ubah_foto_kendaraan')
@include('component.pengaturan.ubah_kata_sandi')

<script src="{{ asset('js/pengaturan.js') }}"></script>

@endsection
