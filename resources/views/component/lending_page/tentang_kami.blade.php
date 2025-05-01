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
