    <!DOCTYPE html>
    <html lang="id" class="scroll-smooth">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Landing Page</title>

        <!-- Tailwind CDN -->
        <script src="https://cdn.tailwindcss.com"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
        <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js"></script>

        <style>
            .marquee-container {
                position: relative;
                width: 100%;
                overflow: hidden;
                white-space: nowrap;
            }

            .marquee-content {
                display: inline-block;
                padding-left: 100%;
                animation: marquee 15s linear infinite;
                font-size: 1.25rem;
                font-weight: 600;
                color: #1f2937;
            }

            .marquee-container:hover .marquee-content {
                animation-play-state: paused;
            }

            @keyframes marquee {
                0% { transform: translateX(0%); }
                100% { transform: translateX(-100%); }
            }

            @media (max-width: 768px) {
                .marquee-content {
                    font-size: 1rem;
                }
            }

            /* Animasi untuk form */
            .form-container {
                width: 200%;
                display: flex;
                transition: transform 0.5s ease;
            }

            .form-page {
                width: 50%;
                min-width: 50%;
            }

            /* Animasi untuk toggle section */
            .toggle-dot {
                transition: all 0.3s ease;
            }

            .toggle-dot.active {
                background-color: white;
                transform: scale(1.2);
            }

            /* Animasi teks */
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            #toggleTitle, #toggleButton {
                animation: fadeInUp 0.6s ease-out forwards;
            }

            /* Custom colors */
            .bg-biru_tua {
                background-color: #1e3a8a;
            }

            .bg-biru_muda {
                background-color: #3b82f6;
            }

            .bg-hijau {
                background-color: #10b981;
            }
        </style>
        <style>
            /* Style untuk modal tengah */
            .modal-center {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                z-index: 50;
            }

            /* Container modal */
            .modal-container {
                display: flex;
                max-height: 100vh; /* Maksimal 90% tinggi viewport */
                overflow-y: auto; /* Scroll jika konten terlalu tinggi */
            }
        </style>
    </head>

    <body class="bg-gray-100">
        <!-- Navbar -->
        <nav class="bg-biru_tua shadow-lg font-poppins sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <img src="images/icon.png" alt="Logo" class="w-10 h-10 border-2 border-white rounded-full object-cover" />
                    <div class="text-xl font-bold text-white">SIPPP</div>
                </div>

                <div>
                    <a href="#tentang" class="text-white hover:text-blue-500 px-4">Tentang</a>
                    <a href="#keunggulan" class="text-white hover:text-blue-500 px-4">Keunggulan</a>
                    <a href="javascript:void(0);" onclick="openModal()" class="bg-biru_muda hover:bg-white hover:text-biru_muda text-white font-semibold px-6 py-2 rounded-full transition duration-300 shadow">Login</a>
                </div>
            </div>
        </nav>

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
                                <form>
                                    <div class="py-2 relative">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-white z-10">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <input type="email" placeholder="Email" class="pl-10 w-full bg-white/20 backdrop-blur-md backdrop-saturate-200 border border-white/30 text-white placeholder-white/70 px-3 py-2 rounded-2xl shadow-md focus:outline-none focus:ring-1 focus:ring-white focus:border-white/50" />
                                    </div>
                                    <div class="py-2 relative">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-white z-10">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                        <input type="password" placeholder="Password" class="pl-10 w-full bg-white/20 backdrop-blur-md backdrop-saturate-200 border border-white/30 text-white placeholder-white/70 px-3 py-2 rounded-2xl shadow-md focus:outline-none focus:ring-1 focus:ring-white focus:border-white/50" />
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
                                <form>
                                    <div class="py-2 relative">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-white z-10">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input type="text" placeholder="Username" class="pl-10 w-full bg-white/20 backdrop-blur-md backdrop-saturate-200 border border-white/30 text-white placeholder-white/70 px-3 py-2 rounded-2xl shadow-md focus:outline-none focus:ring-1 focus:ring-white focus:border-white/50" />
                                    </div>
                                    <div class="py-2 relative">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-white z-10">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <input type="email" placeholder="Email" class="pl-10 w-full bg-white/20 backdrop-blur-md backdrop-saturate-200 border border-white/30 text-white placeholder-white/70 px-3 py-2 rounded-2xl shadow-md focus:outline-none focus:ring-1 focus:ring-white focus:border-white/50" />
                                    </div>
                                    <div class="py-2 relative">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-white z-10">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                        <input type="password" placeholder="Password" class="pl-10 w-full bg-white/20 backdrop-blur-md backdrop-saturate-200 border border-white/30 text-white placeholder-white/70 px-3 py-2 rounded-2xl shadow-md focus:outline-none focus:ring-1 focus:ring-white focus:border-white/50" />
                                    </div>
                                    <div class="py-2 relative">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-white z-10">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                        <input type="password" placeholder="Konfirmasi Password" class="pl-10 w-full bg-white/20 backdrop-blur-md backdrop-saturate-150 border border-white/30 text-white placeholder-white/70 px-3 py-2 rounded-2xl shadow-md focus:outline-none focus:ring-1 focus:ring-white focus:border-white/50" />
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

        <!-- Hero -->
        <section class="relative h-[calc(100vh-4rem)]">
            <div class="absolute inset-0 z-10 flex flex-col justify-center items-center text-white bg-black/40 text-center px-4">
                <h5 class="text-3xl md:text-5xl font-bold font-poppins mb-2">SELAMAT DATANG DI HALAMAN WEB</h5>
                <h1 class="text-6xl font-londrina drop-shadow-lg">SIPPP</h1>
                <p class="text-base md:text-lg mt-2 font-poppins">Layanan online parkir yang mempermudah hari anda</p>
            </div>

            <div id="slider" class="flex transition-transform duration-700 ease-in-out h-full">
                <img src="img/Gedung.jpg" class="w-full object-cover flex-shrink-0" alt="Gedung" />
                <img src="img/techno.jpg" class="w-full object-cover flex-shrink-0" alt="Techno" />
                <img src="img/keunggulan.png" class="w-full object-cover flex-shrink-0" alt="Keunggulan" />
            </div>
        </section>


        <div class="bg-white p-5">
            <div class="grid grid-cols-3 gap-5 h-96">
                <div class="bg-red-600"></div>
                <div class="bg-blue-600"></div>
                <div class="bg-green-600"></div>
            </div>
        </div>

        <!-- Tentang Kami -->
        <section id="tentang" class="flex flex-col md:flex-row font-poppins min-h-[600px]">
            <div class="w-full md:w-1/2 bg-white flex items-center justify-center p-10">
                <div class="max-w-lg">
                    <h2 class="text-4xl font-bold mb-4 text-gray-800">Tentang Kami</h2>
                    <p class="mb-2 text-gray-600">Latar belakang dari pengembangan website SIPPP adalah sebagai berikut:</p>
                    <ul class="list-disc list-inside text-gray-500 space-y-1">
                        <li>Mempermudah pemantauan parkir di lingkungan Polibatam.</li>
                        <li>Proyek Mahasiswa Teknik Informatika Polibatam.</li>
                        <li>Terintegrasi real-time dengan kondisi parkiran.</li>
                        <li>Proses pengembangan selama 6 bulan.</li>
                        <li>Dibimbing oleh Ibu Fida.</li>
                    </ul>
                </div>
            </div>
            <div class="w-full md:w-1/2 relative overflow-hidden">
                <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
                <model-viewer src="{{asset('3d_model/mercedes_300sl.glb')}}" alt="3D Model Sistem Parkir Polibatam" class="h-full w-full min-h-[400px] bg-white" camera-controls auto-rotate ar shadow-intensity="1.2" exposure="0.9" environment-image="neutral" interaction-prompt="when-focused" camera-orbit="0deg 75deg 105%" field-of-view="30deg">
                    <div class="progress-bar" slot="progress-bar"></div>
                </model-viewer>
            </div>
        </section>

        <!-- Keunggulan -->
        <section id="keunggulan" class="flex flex-col md:flex-row font-poppins min-h-[600px]">
            <div class="w-full md:w-1/2 relative overflow-hidden">
                <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
                <model-viewer src="{{asset('3d_model/sign_parking.glb')}}" alt="3D Model Sistem Parkir Polibatam" class="h-full w-full min-h-[400px] bg-white" camera-controls auto-rotate ar shadow-intensity="1.2" exposure="0.9" environment-image="neutral" interaction-prompt="when-focused" camera-orbit="0deg 75deg 105%" field-of-view="30deg">
                    <div class="progress-bar" slot="progress-bar"></div>
                </model-viewer>
            </div>
            <div class="w-full md:w-1/2 bg-white flex items-center justify-center p-10">
                <div class="max-w-lg">
                    <h2 class="text-4xl font-bold mb-4 text-gray-800">Keunggulan Kami</h2>
                    <ul class="list-disc list-inside text-gray-500 space-y-1">
                        <li>Terintegrasi secara real time dengan kondisi slot parkir</li>
                        <li>Responsif dan ramah pengguna</li>
                        <li>Proses masuk dan keluar kendaraan otomatis</li>
                        <li>Sistem laporan parkir lengkap</li>
                        <li>Antarmuka modern dan profesional</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer id="footer" class="bg-biru_tua text-white py-5">
            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 px-4">
                <div>
                    <h2 class="text-lg font-bold mb-4">SIPPP</h2>
                    <p class="text-sm">Sistem Informasi Pemantauan Parkir Polibatam secara real-time dan efisien.</p>
                </div>
                <div class="flex justify-center">
                    <div>
                        <h3 class="text-lg font-bold mb-4">Navigasi</h3>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#tentang" class="hover:underline">Tentang</a></li>
                            <li><a href="#keunggulan" class="hover:underline">Keunggulan</a></li>
                            <li><a href="#footer" class="hover:underline">Kontak</a></li>
                        </ul>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Kontak Kami</h3>
                    <p class="text-sm">Email: sipp@gmail.com</p>
                    <p class="text-sm">Telepon: 0852-6423-5208</p>
                    <p class="text-sm">Alamat: Jl. Ahmad Yani, Tlk. Tering, Batam</p>
                    <div class="flex space-x-4 text-white text-xl mt-2">
                        <a href="#"><i class="fab fa-instagram hover:text-gray-300"></i></a>
                        <a href="#"><i class="fab fa-facebook-f hover:text-gray-300"></i></a>
                        <a href="#"><i class="fab fa-youtube hover:text-gray-300"></i></a>
                    </div>
                </div>
            </div>
        </footer>

        <script>
            // Script untuk slider
            let slider = document.getElementById('slider');
            let index = 0;

            if (slider) {
                setInterval(() => {
                    index = (index + 1) % slider.children.length;
                    slider.style.transform = `translateX(-${index * 100}%)`;
                }, 5000);
            }

            // Modal functions
            function openModal() {
                document.getElementById("loginModal").classList.remove("hidden");
            }

            function closeModal() {
                document.getElementById("loginModal").classList.add("hidden");
            }

            function toggleForm() {
                const formContainer = document.getElementById('formSlider');
                const toggleTitle = document.getElementById('toggleTitle');
                const toggleButton = document.getElementById('toggleButton');
                const toggleDots = document.querySelectorAll('.toggle-dot');

                // Toggle transform
                if (formContainer.style.transform === 'translateX(-50%)') {
                    formContainer.style.transform = 'translateX(0)';
                    toggleTitle.textContent = 'Selamat Datang Kembali';
                    toggleButton.textContent = 'Belum memiliki akun?';
                    toggleDots[0].classList.add('active');
                    toggleDots[1].classList.remove('active');
                } else {
                    formContainer.style.transform = 'translateX(-50%)';
                    toggleTitle.textContent = 'Bergabunglah Dengan Kami';
                    toggleButton.textContent = 'Sudah memiliki akun?';
                    toggleDots[0].classList.remove('active');
                    toggleDots[1].classList.add('active');
                }

                // Reset animasi
                toggleTitle.style.animation = 'none';
                toggleButton.style.animation = 'none';
                setTimeout(() => {
                    toggleTitle.style.animation = '';
                    toggleButton.style.animation = '';
                }, 10);
            }
        </script>

    </body>
    </html>
