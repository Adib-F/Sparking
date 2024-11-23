@extends('layout.mainUser')

@section('main')
    <div class="container mx-auto px-4 py-4 md:py-8 max-w-[1920px]">
        <header class="flex items-center justify-between mb-4 md:mb-0">
            <img alt="Logo of the company" class="h-8 -mt-2 md:h-12 md:-mt-5" src="{{ asset('images/PolobatamLogo.png') }}"/>
            <img alt="Indonesian flag" class="h-6 -mt-2 md:h-10 md:-mt-5" src="{{ asset('images/Indonesia.png') }}"/>
        <!-- header responsive -->
        </header>

        <main class="flex flex-col items-center justify-center gap-6 pt-10 md:gap-12 md:pt-10">
            <!-- ukuran logo responsive -->
            <div class="w-full max-w-md">
                <img alt="Parkwell logo" class="h-24 mx-auto md:h-32" src="{{ asset('images/LogoParkwell.png') }}"/>
            </div>

            <!-- ukuran form reggistrasi -->
            <div class="w-full max-w-[90%] md:max-w-md -mt-2 md:-mt-5">
                <div class="px-8 pt-6 pb-8 bg-white rounded-lg shadow-lg">
                    <h2 class="mb-4 text-2xl font-bold text-center md:text-3xl md:mb-6">Registrasi</h2>
                    <form action="{{ route('registrasi_proses')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- input nama pengguna -->
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="vehicle">
                                <i class="mr-2 fas fa-list"></i>Jenis Pengguna
                            </label>
                            <input class="w-full px-4 py-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline md:text-base " id="username" placeholder="Nama Pengguna" type="text" name="nama" required/>
                        </div>
                        <!-- input email -->
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                                <i class="mr-2 fas fa-envelope"></i>Email
                            </label>
                            <input class="w-full px-4 py-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline md:text-base" id="email" placeholder="Email" type="email" name="email" required/>
                        </div>
                        <!-- input jenis kendaraan -->
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="vehicle">
                                <i class="mr-2 fas fa-car"></i>Pilih Kendaraan
                            </label>
                            <select class="w-full px-4 py-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline md:text-base" id="vehicle" name="kendaraan" required>
                                <option>Pilih Kendaraan</option>
                                <option>Mobil</option>
                                <option>Motor</option>
                            </select>
                        </div>
                        <!-- input plat kendaraan -->
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="plate">
                                <i class="mr-2 fas fa-id-card"></i>Plat Kendaraan
                            </label>
                            <input class="w-full px-4 py-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline md:text-base" id="plate" placeholder="Plat Kendaraan" type="text" name="no_plat" required/>
                        </div>
                        <!-- input kata sandi -->
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="file">
                                <i class="mr-2 fas fa-camera"></i>Foto Kendaraan
                            </label>
                            <input class="w-full px-4 py-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline md:text-base" id="password" placeholder="Kata Sandi" type="password" name="password" required/>
                        </div>
                        <!-- input file -->
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="file">
                                <i class="mr-2 fas fa-image"></i>Foto Pengguna
                            </label>
                            <input class="w-full px-4 py-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline md:text-base" id="file" type="file" name="gambar" required/>
                        </div>
                        <!-- button registrasi -->
                        <div class="flex items-center justify-between">
                            <button class="w-full px-6 py-3 font-bold text-white transition duration-300 bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline" type="submit">
                                Registrasi
                            </button>
                        </div>
                    </form>
                    <p class="mt-6 text-sm text-center text-gray-500">
                        Sudah punya akun? <a class="text-blue-500 hover:text-blue-700" href="{{ route('login')}}">Masuk</a>
                    </p>
                </div>
            </div>
        </main>
    </div>
@endsection
