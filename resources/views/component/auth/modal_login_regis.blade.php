<!-- Modal Login/Register -->
<div id="loginModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-20 top-[4rem] hidden">
    <div class="bg-white flex rounded-3xl w-[90%] md:w-[80%] lg:w-[70%] xl:w-[60%] max-w-4xl relative h-[80%]">
        <button onclick="closeModal()" class="absolute top-3 left-3 text-black hover:text-red-600 text-xl z-30">
            <i class="fas fa-times"></i>
        </button>

        <!-- Toggle Section -->
        <div class="w-1/2 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center relative rounded-l-2xl">
            <div class="text-center z-20 px-8">
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-6 tracking-wider" id="toggleTitle">Selamat Datang Kembali</h2>
                <p class="text-white/90 mb-8 text-sm">Masuk untuk mengakses akun Anda dan menjelajahi lebih banyak fitur</p>
                <button type="button" onclick="toggleForm()"
                        class="px-4 py-2 md:px-6 md:py-3 bg-white/20 backdrop-blur-sm border-2 border-white/30 text-white rounded-full hover:bg-white/30 hover:border-white/50 transition-all duration-500 transform hover:scale-105 shadow-lg text-sm md:text-base"
                        id="toggleButton">
                    Belum memiliki akun?
                </button>
            </div>
            <div class="absolute bottom-0 left-0 right-0 flex justify-center pb-8 z-20">
                <div class="flex space-x-2">
                    <div class="w-2 h-2 md:w-3 md:h-3 rounded-full bg-white/80 toggle-dot active"></div>
                    <div class="w-2 h-2 md:w-3 md:h-3 rounded-full bg-white/30 toggle-dot"></div>
                </div>
            </div>
        </div>

        <!-- Form Container -->
        <div class="w-1/2 h-full relative overflow-hidden">
            <img src="img/login.jpg" alt="Login Image" class="absolute inset-0 w-full h-full object-cover rounded-r-2xl" />
            <div class="form-container absolute inset-0" id="formSlider">
                <!-- Login Form -->
                <div class="form-page flex items-center justify-center p-10">
                    <div class="z-20 bg-white/30 backdrop-blur-md backdrop-saturate-150 p-4 md:p-6 rounded-xl shadow-lg border border-white w-full max-w-md">
                        <h2 class="text-xl md:text-2xl text-center font-extrabold mb-3 text-white font-poppins tracking-widest">Login</h2>
                        <form action="{{route('login_proses')}}" method="POST">
                            <div class="py-2 relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-white z-10">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                @error('email')
                                    <div class="mt-1 text-red-500">{{ $message }}</div>
                                @enderror
                                <input type="email" placeholder="Email" name="email" value="{{old('email')}}" class="pl-10 w-full bg-white/20 backdrop-blur-md backdrop-saturate-200 border border-white/30 text-white placeholder-white/70 px-3 py-2 rounded-2xl shadow-md focus:outline-none focus:ring-1 focus:ring-white focus:border-white/50" />
                            </div>
                            <div class="py-2 relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-white z-10">
                                    <i class="fas fa-lock"></i>
                                </span>
                                @error('password')
                                    <div class="mt-1 text-red-500">{{ $message }}</div>
                                @enderror
                                <input type="password" placeholder="Password" name="password" value="{{old('pasword')}}" class="pl-10 w-full bg-white/20 backdrop-blur-md backdrop-saturate-200 border border-white/30 text-white placeholder-white/70 px-3 py-2 rounded-2xl shadow-md focus:outline-none focus:ring-1 focus:ring-white focus:border-white/50" />
                            </div>
                            <div class="flex flex-col items-center space-y-2 mb-2 mt-6">
                                <button type="submit" class="w-4/5 bg-white text-black border border-white px-4 py-2 rounded-2xl shadow-md hover:bg-opacity-90 hover:shadow-lg transition-all duration-300 font-semibold tracking-wide">
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Register Form -->
                <div class="form-page flex items-center h-full p-10">
                    <div class="z-20 bg-white/30 backdrop-blur-md backdrop-saturate-150 p-4 md:p-6 rounded-xl shadow-lg border border-white w-full max-w-md">
                        <h2 class="text-xl md:text-2xl text-center font-extrabold mb-3 text-white font-poppins tracking-widest">Daftar</h2>
                        <form action="{{ route('registrasi_proses') }}" method="POST">
                            <div class="py-2 relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-white z-10">
                                    <i class="fas fa-user"></i>
                                </span>
                                @error('nama')
                                    <div class="mt-1 text-red-500">{{ $message }}</div>
                                @enderror
                                <input type="text" placeholder="Nama Lengkap" name="nama" value="{{old('nama')}}" class="pl-10 w-full bg-white/20 backdrop-blur-md backdrop-saturate-200 border border-white/30 text-white placeholder-white/70 px-3 py-2 rounded-2xl shadow-md focus:outline-none focus:ring-1 focus:ring-white focus:border-white/50" />
                            </div>
                            <div class="py-2 relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-white z-10">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                @error('email')
                                    <div class="mt-1 text-red-500">{{ $message }}</div>
                                @enderror
                                <input type="email" placeholder="Email" name="email" value="{{old('email')}}" class="pl-10 w-full bg-white/20 backdrop-blur-md backdrop-saturate-200 border border-white/30 text-white placeholder-white/70 px-3 py-2 rounded-2xl shadow-md focus:outline-none focus:ring-1 focus:ring-white focus:border-white/50" />
                            </div>
                            <div class="py-2 relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-white z-10">
                                    <i class="fas fa-lock"></i>
                                </span>
                                @error('email')
                                    <div class="mt-1 text-red-500">{{ $message }}</div>
                                @enderror
                                <input type="password" placeholder="Password" name="password" value="{{old('password')}}" class="pl-10 w-full bg-white/20 backdrop-blur-md backdrop-saturate-200 border border-white/30 text-white placeholder-white/70 px-3 py-2 rounded-2xl shadow-md focus:outline-none focus:ring-1 focus:ring-white focus:border-white/50" />
                            </div>
                            <div class="py-2 relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-white z-10">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" placeholder="password_confirmation" name="password_confirmation" class="pl-10 w-full bg-white/20 backdrop-blur-md backdrop-saturate-150 border border-white/30 text-white placeholder-white/70 px-3 py-2 rounded-2xl shadow-md focus:outline-none focus:ring-1 focus:ring-white focus:border-white/50" />
                            </div>
                            <div class="flex flex-col items-center space-y-2 mb-2 mt-6">
                                <button type="submit" class="w-4/5 bg-white text-black border border-white px-4 py-2 rounded-2xl shadow-md hover:bg-opacity-90 hover:shadow-lg transition-all duration-300 font-semibold tracking-wide">
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
