@extends('layout.mainUser')

@include('component/headerUser')

@section('main')
    @include('component.auth.modal_login_regis')
    @if (session('error') || $errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showModal();
            });
        </script>
    @endif

    <!-- kemungkinan di ubah menjadi 1 gambar yagn uda di edit -->
    <section class="relative h-[calc(100vh-4rem)]">
        <div class="absolute inset-0 z-10 flex flex-col items-center justify-center px-4 text-center text-white bg-black/40">
            <h5 class="mb-2 text-3xl font-bold md:text-5xl font-poppins">SELAMAT DATANG DI HALAMAN WEB</h5>
            <h1 class="text-6xl font-londrina drop-shadow-lg">SIPPP</h1>
            <p class="mt-2 text-base md:text-lg font-poppins">Layanan online parkir yang mempermudah hari anda</p>
        </div>

        <div id="slider" class="flex h-full transition-transform duration-700 ease-in-out">
            <img src="img/Gedung.jpg" class="flex-shrink-0 object-cover w-full" alt="Gedung" />
            <img src="img/techno.jpg" class="flex-shrink-0 object-cover w-full" alt="Techno" />
            <img src="img/keunggulan.png" class="flex-shrink-0 object-cover w-full" alt="Keunggulan" />
        </div>
    </section>

    @include('component.lending_page.animasi_tiga_gambar')


    @include('component.lending_page.tentang_kami')


    @include('component.lending_page.keunggulan')

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

            //  Reset animasi
            toggleTitle.style.animation = 'none';
            toggleButton.style.animation = 'none';
            setTimeout(() => {
                toggleTitle.style.animation = '';
                toggleButton.style.animation = '';
            }, 10);
        }

        function showModal() {
            document.getElementById("loginModal").classList.remove("hidden");
            document.getElementById("loginModal").classList.add("flex");
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // @if(session('success'))
            //     // Tampilkan alert jika pendaftaran berhasil
            //     alert("{{ session('success') }}");
            // @endif

            @if(session('showLogin'))
                // Buka modal login dan geser ke form login
                const modal = document.getElementById('loginModal');
                modal.classList.remove('hidden');

                // Geser ke halaman login
                const formSlider = document.getElementById('formSlider');
                if (formSlider) {
                    formSlider.style.transform = 'translateX(0%)';
                }

                // Atur judul dan tombol toggle
                document.getElementById('toggleTitle').innerText = 'Selamat Datang Kembali';
                document.getElementById('toggleButton').innerText = 'Belum memiliki akun?';
                const dots = document.querySelectorAll('.toggle-dot');
                if (dots.length >= 2) {
                    dots[0].classList.add('active');
                    dots[1].classList.remove('active');
                }
            @endif
        });
    </script>


    @include('component/footerUser')
@endsection
