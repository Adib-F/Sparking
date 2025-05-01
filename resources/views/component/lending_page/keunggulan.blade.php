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
