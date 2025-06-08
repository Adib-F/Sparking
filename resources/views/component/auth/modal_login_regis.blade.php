<!-- Modal Login/Register -->
<div id="loginModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-20 top-[4rem] hidden">
    <div class="bg-white flex rounded-3xl w-[90%] md:w-[80%] lg:w-[70%] xl:w-[60%] max-w-4xl relative h-[80%]">
        <button onclick="closeModal()" class="absolute z-30 text-xl text-black top-3 left-3 hover:text-red-600">
            <i class="fas fa-times"></i>
        </button>

        <!-- Toggle Section -->
        <div class="relative flex items-center justify-center w-1/2 bg-gradient-to-br from-blue-500 to-purple-600 rounded-l-2xl">
            <div class="z-20 px-8 text-center">
                <h2 class="mb-6 text-2xl font-bold tracking-wider text-white md:text-3xl" id="toggleTitle">Selamat Datang Kembali</h2>
                <p class="mb-8 text-sm text-white/90">Masuk untuk mengakses akun Anda dan menjelajahi lebih banyak fitur</p>
                <button type="button" onclick="toggleForm()"
                        class="px-4 py-2 text-sm text-white transition-all duration-500 transform border-2 rounded-full shadow-lg md:px-6 md:py-3 bg-white/20 backdrop-blur-sm border-white/30 hover:bg-white/30 hover:border-white/50 hover:scale-105 md:text-base"
                        id="toggleButton">
                    Belum memiliki akun?
                </button>
            </div>
            <div class="absolute bottom-0 left-0 right-0 z-20 flex justify-center pb-8">
                <div class="flex space-x-2">
                    <div class="w-2 h-2 rounded-full md:w-3 md:h-3 bg-white/80 toggle-dot active"></div>
                    <div class="w-2 h-2 rounded-full md:w-3 md:h-3 bg-white/30 toggle-dot"></div>
                </div>
            </div>
        </div>

        <!-- Form Container -->
        <div class="relative w-1/2 h-full overflow-hidden">
            <img src="img/login.jpg" alt="Login Image" class="absolute inset-0 object-cover w-full h-full rounded-r-2xl" />
            <div class="absolute inset-0 form-container" id="formSlider">
                <!-- Login Form -->
                <div class="flex items-center justify-center p-10 form-page">
                    <div class="z-20 w-full max-w-md p-4 border border-white shadow-lg bg-white/30 backdrop-blur-md backdrop-saturate-150 md:p-6 rounded-xl">
                        <h2 class="mb-3 text-xl font-extrabold tracking-widest text-center text-white md:text-2xl font-poppins">Login</h2>
                        <form action="{{route('login_proses')}}" method="POST">
                            @csrf
                            <div class="relative py-2">
                                <span class="absolute inset-y-0 left-0 z-10 flex items-center pl-3 text-white">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                @error('email')
                                    <div class="mt-1 text-red-500">{{ $message }}</div>
                                @enderror
                                <input type="email" placeholder="Email" name="email" value="{{old('email')}}" class="w-full px-3 py-2 pl-10 text-white border shadow-md bg-white/20 backdrop-blur-md backdrop-saturate-200 border-white/30 placeholder-white/70 rounded-2xl focus:outline-none focus:ring-1 focus:ring-white focus:border-white/50" />
                            </div>
                            <div class="relative py-2">
                                <span class="absolute inset-y-0 left-0 z-10 flex items-center pl-3 text-white">
                                    <i class="fas fa-lock"></i>
                                </span>
                                @error('password')
                                    <div class="mt-1 text-red-500">{{ $message }}</div>
                                @enderror
                                <input type="password" placeholder="Password" name="password" value="{{old('pasword')}}" class="w-full px-3 py-2 pl-10 text-white border shadow-md bg-white/20 backdrop-blur-md backdrop-saturate-200 border-white/30 placeholder-white/70 rounded-2xl focus:outline-none focus:ring-1 focus:ring-white focus:border-white/50" />
                            </div>
                            <div class="flex flex-col items-center mt-6 mb-2 space-y-2">
                                <button name="login_path" type="submit" class="w-4/5 px-4 py-2 font-semibold tracking-wide text-black transition-all duration-300 bg-white border border-white shadow-md rounded-2xl hover:bg-opacity-90 hover:shadow-lg">
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Register Form -->
                <div class="flex items-center h-full p-10 form-page">
                    <div class="z-20 w-full max-w-md p-4 border border-white shadow-lg bg-white/30 backdrop-blur-md backdrop-saturate-150 md:p-6 rounded-xl">
                        <h2 class="mb-3 text-xl font-extrabold tracking-widest text-center text-white md:text-2xl font-poppins">Daftar</h2>
                        <form action="{{ route('registrasi_proses') }}" method="POST">
                            @csrf
                            <div class="relative py-2">
                                <span class="absolute inset-y-0 left-0 z-10 flex items-center pl-3 text-white">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input type="text" placeholder="Nama Lengkap" name="nama" value="{{old('nama')}}" class="w-full px-3 py-2 pl-10 text-white border shadow-md bg-white/20 backdrop-blur-md backdrop-saturate-200 border-white/30 placeholder-white/70 rounded-2xl focus:outline-none focus:ring-1 focus:ring-white focus:border-white/50" />
                            </div>
                            <div class="relative py-2">
                                <span class="absolute inset-y-0 left-0 z-10 flex items-center pl-3 text-white">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email" placeholder="Email" name="email" value="{{old('email')}}" class="w-full px-3 py-2 pl-10 text-white border shadow-md bg-white/20 backdrop-blur-md backdrop-saturate-200 border-white/30 placeholder-white/70 rounded-2xl focus:outline-none focus:ring-1 focus:ring-white focus:border-white/50" />
                            </div>
                            <div class="relative py-2">
                                <span class="absolute inset-y-0 left-0 z-10 flex items-center pl-3 text-white">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" placeholder="Password" name="password" value="{{old('password')}}" class="w-full px-3 py-2 pl-10 text-white border shadow-md bg-white/20 backdrop-blur-md backdrop-saturate-200 border-white/30 placeholder-white/70 rounded-2xl focus:outline-none focus:ring-1 focus:ring-white focus:border-white/50" />
                            </div>
                            <div class="relative py-2">
                                <span class="absolute inset-y-0 left-0 z-10 flex items-center pl-3 text-white">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" placeholder="Konfirmasi Password" name="password_confirmation" class="w-full px-3 py-2 pl-10 text-white border shadow-md bg-white/20 backdrop-blur-md backdrop-saturate-150 border-white/30 placeholder-white/70 rounded-2xl focus:outline-none focus:ring-1 focus:ring-white focus:border-white/50" />
                            </div>
                            <div class="flex flex-col items-center mt-6 mb-2 space-y-2">
                                <button type="submit" class="w-4/5 px-4 py-2 font-semibold tracking-wide text-black transition-all duration-300 bg-white border border-white shadow-md rounded-2xl hover:bg-opacity-90 hover:shadow-lg">
                                    Daftar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

