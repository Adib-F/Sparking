<div class="p-6 bg-white shadow-xl rounded-2xl">
    <h2 class="flex items-center mb-6 text-2xl font-bold text-gray-800">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
        </svg>
        Informasi Detail Zona
    </h2>

    <div class="flex flex-col gap-6 lg:flex-row">
        <div class="p-6 space-y-4 border border-gray-100 shadow-inner lg:w-1/3 bg-gray-50 rounded-xl">
            <!-- Dropdown Pilih Zona -->
            <div class="relative mb-6">
                <select id="zona-select" class="w-full px-4 py-3 bg-white border border-gray-300 shadow-sm appearance-none rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                    <option value="" disabled {{ is_null($selectedZonaId) ? 'selected' : '' }}>Pilih Zona</option>
                    @foreach ($zonas as $zona)
                        <option value="{{ $zona->id }}" {{ $selectedZonaId == $zona->id ? 'selected' : '' }}>
                            {{ $zona->nama_zona }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Dropdown Pilih Sub Zona -->
            <div class="relative mb-6">
                <select id="subzona-select" class="w-full px-4 py-3 bg-white border border-gray-300 shadow-sm appearance-none rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                    <option value="" disabled {{ is_null($selectedSubzonaId) ? 'selected' : '' }}>Pilih Sub Zona</option>
                    @foreach ($subzonas as $subzona)
                        <option value="{{ $subzona->id }}" {{ $selectedSubzonaId == $subzona->id ? 'selected' : '' }}>
                            {{ $subzona->nama_subzona }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="p-4 bg-white border border-gray-200 rounded-xl">
                <h4 class="mb-2 font-semibold text-blue-800">Status Real Time</h4>
                <ul class="space-y-2">
                    <li class="flex justify-between">
                        <span class="text-gray-600">Total Zona:</span>
                        <span class="font-medium">{{ $totalZona }} Zona</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="text-gray-600">Total Sub Zona:</span>
                        <span class="font-medium">{{ $totalSubzona }} Sub Zona</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="text-gray-600">Total Slot:</span>
                        <span class="font-medium text-green-600">{{ $totalSlot }} Slot</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- detail sub zona -->
        <div class="p-6 bg-white border border-gray-100 shadow-lg lg:w-2/3 rounded-xl">
            <h3 class="mb-4 text-xl font-semibold text-gray-800">Detail Sub Zona</h3>

            <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                <div class="p-4 border border-gray-200 rounded-lg shadow-sm bg-gray-50">
                    <div class="flex items-center mb-2">
                        <div class="p-2 mr-3 bg-gray-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                        </div>
                        <h4 class="font-medium text-gray-700">Total Slot Subzona</h4>
                    </div>
                    <p id="total" class="text-3xl font-bold text-gray-900 ml-11">{{ $selectedSubzonaId ? $slotStats['total'] : '-' }}</p>
                </div>

                <div class="p-4 border border-gray-200 rounded-lg shadow-sm bg-gray-50">
                    <div class="flex items-center mb-2">
                        <div class="p-2 mr-3 bg-blue-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h4 class="font-medium text-gray-700">Slot parkiran yang tersedia</h4>
                    </div>
                    <p id="tersedia" class="text-3xl font-bold text-blue-600 ml-11">{{ $selectedSubzonaId ? $slotStats['tersedia'] : '-' }}</p>
                </div>

                <div class="p-4 border border-gray-200 rounded-lg shadow-sm bg-gray-50">
                    <div class="flex items-center mb-2">
                        <div class="p-2 mr-3 bg-red-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <h4 class="font-medium text-gray-700">Slot parkiran yang terisi</h4>
                    </div>
                    <p id="terisi" class="text-3xl font-bold text-red-600 ml-11">{{ $selectedSubzonaId ? $slotStats['terisi'] : '-' }}</p>
                </div>

                <div class="p-4 border border-gray-200 rounded-lg shadow-sm bg-gray-50">
                    <div class="flex items-center mb-2">
                        <div class="p-2 mr-3 bg-yellow-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h4 class="font-medium text-gray-700">Slot parkiran yang sedang diperbaiki</h4>
                    </div>
                    <p id="perbaikan" class="text-3xl font-bold text-yellow-600 ml-11">{{ $selectedSubzonaId ? $slotStats['diperbaiki'] : '-' }}</p>
                </div>
            </div>

            @include('component/real-time/tampilkan_sub_zona')

        </div>
    </div>
</div>



<script>
    let pollingInterval;
    let currentSubzonaId = "{{ $selectedSubzonaId ?? '' }}";
    let videoStreamInstance = null;

    class VideoStream {
        constructor(cameraId, elementId, subzonaId) {
            if (!subzonaId) throw new Error("subzonaId required");
            this.cameraId = cameraId;
            this.elementId = elementId;
            this.subzonaId = subzonaId;
            this.init();
        }

        init() {
            const timestamp = Date.now();
            this.streamUrl = `http://127.0.0.1:5000/video_feed?camera_id=${this.cameraId}&subzona_id=${this.subzonaId}&t=${timestamp}`;
            console.log("Starting stream:", this.streamUrl);

            const videoElement = document.getElementById(this.elementId);
            videoElement.src = this.streamUrl;

            videoElement.onerror = () => {
                console.error("Stream error, retrying...");
                this.retry();
            };
        }

        retry() {
            setTimeout(() => this.init(), 3000);
        }

        stop() {
            const videoElement = document.getElementById(this.elementId);
            videoElement.src = '';
            console.log("Stream stopped");
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const zonaSelect = document.getElementById('zona-select');
        const subzonaSelect = document.getElementById('subzona-select');
        const closeBtn = document.getElementById('closeModalBtn');

        // Tutup modal
        closeBtn?.addEventListener('click', () => {
            document.getElementById('subZoneModal').classList.add('hidden');
            if (pollingInterval) clearInterval(pollingInterval);
            if (videoStreamInstance) {
                videoStreamInstance.stop();
                videoStreamInstance = null;
            }
        });

        // Zona berubah -> ambil subzona
        zonaSelect?.addEventListener('change', function () {
            const zonaId = this.value;
            if (!zonaId) return;

            subzonaSelect.innerHTML = '<option selected disabled>Loading...</option>';
            resetSlotStats();

            fetch(`/api/get-subzonas/${zonaId}`)
                .then(res => {
                    if (!res.ok) throw new Error(`HTTP error! status: ${res.status}`);
                    return res.json();
                })
                .then(data => {
                    subzonaSelect.innerHTML = '<option value="" disabled selected>Pilih Sub Zona</option>';
                    data.forEach(subzona => {
                        const option = document.createElement('option');
                        option.value = subzona.id;
                        option.textContent = subzona.nama_subzona;
                        subzonaSelect.appendChild(option);
                    });

                    if (currentSubzonaId) {
                        subzonaSelect.value = currentSubzonaId;
                        loadSubzonaData(currentSubzonaId);
                    }
                })
                .catch(error => {
                    console.error('Gagal mengambil subzona:', error);
                    subzonaSelect.innerHTML = '<option value="" disabled selected>Pilih Sub Zona</option>';
                    resetSlotStats();
                });
        });

        // Subzona berubah
        subzonaSelect?.addEventListener('change', function () {
            currentSubzonaId = this.value;
            if (!currentSubzonaId) return;
            loadSubzonaData(currentSubzonaId);
        });

        // Jika ada subzona terpilih dari awal
        if (currentSubzonaId) {
            subzonaSelect.value = currentSubzonaId;
            loadSubzonaData(currentSubzonaId);
        }

        // Polling setiap 2 detik
        setInterval(() => {
            if (currentSubzonaId) {
                fetch(`/api/real-time/subzona/${currentSubzonaId}`)
                    .then(res => res.json())
                    .then(data => {
                        const stats = data.slotStats || {};
                        document.getElementById('total').innerText = stats.total ?? '-';
                        document.getElementById('terisi').innerText = stats.terisi ?? '-';
                        document.getElementById('tersedia').innerText = stats.tersedia ?? '-';
                        document.getElementById('perbaikan').innerText = stats.perbaikan ?? '-';
                    })
                    .catch(console.error);
            }
        }, 2000);
    });

    async function loadSubzonaData(subzonaId) {
        try {
            const response = await fetch(`/api/real-time/subzona/${subzonaId}`);
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            const data = await response.json();

            updateSlotStats(data.slotStats);
            document.getElementById('subzoneName').textContent = `Sub Zona: ${data.nama_subzona}`;

            if (Number.isInteger(data.camera_id)) {
                if (videoStreamInstance) videoStreamInstance.stop();
                videoStreamInstance = new VideoStream(data.camera_id, 'subzoneStream', subzonaId);
            } else {
                console.warn('Camera ID tidak tersedia');
                if (videoStreamInstance) {
                    videoStreamInstance.stop();
                    videoStreamInstance = null;
                }
            }

            if (!document.getElementById('subZoneModal').classList.contains('hidden')) {
                updateSubzoneModal(data);
            }

        } catch (error) {
            console.error('Gagal memuat data subzona:', error);
            resetSlotStats();
        }
    }

    function resetSlotStats() {
        document.getElementById('total').innerText = '-';
        document.getElementById('terisi').innerText = '-';
        document.getElementById('tersedia').innerText = '-';
        document.getElementById('perbaikan').innerText = '-';
    }

    function updateSlotStats(stats) {
        if (!stats) return resetSlotStats();
        document.getElementById('total').innerText = stats.total ?? '-';
        document.getElementById('terisi').innerText = stats.terisi ?? '-';
        document.getElementById('tersedia').innerText = stats.tersedia ?? '-';
        document.getElementById('perbaikan').innerText = stats.perbaikan ?? '-';
    }

    function showSubzoneModal() {
        const subzonaId = document.getElementById("subzona-select").value;
        if (!subzonaId) {
            alert("Silakan pilih Sub Zona terlebih dahulu.");
            return;
        }

        fetch(`/api/real-time/subzona/${subzonaId}`)
            .then(response => {
                if (!response.ok) throw new Error(`Gagal mengambil data: ${response.status}`);
                return response.json();
            })
            .then(data => {
                updateSubzoneModal(data);
                document.getElementById('subZoneModal').classList.remove('hidden');

                if (pollingInterval) clearInterval(pollingInterval);
                pollingInterval = setInterval(() => {
                    fetch(`/api/real-time/subzona/${subzonaId}`)
                        .then(res => res.json())
                        .then(updateSubzoneModal)
                        .catch(console.error);
                }, 3000);
            })
            .catch(error => {
                console.error('Error saat mengambil data subzona:', error);
                alert('Gagal memuat data subzona. Pastikan ID valid atau coba lagi nanti.');
            });
    }

    function updateSubzoneModal(data) {
        if (!data) return;

        document.getElementById('subzoneName').textContent = `Sub Zona: ${data.nama_subzona}`;

        if (data.camera_id && videoStreamInstance) {
            videoStreamInstance.cameraId = data.camera_id;
            videoStreamInstance.init();
        }

        const slotGrid = document.getElementById('slotGrid');
        slotGrid.innerHTML = '';

        data.slots?.forEach(slot => {
            const colorClasses = {
                'Tersedia': 'bg-blue-500 text-white',
                'Terisi': 'bg-red-500 text-white',
                'Perbaikan': 'bg-yellow-300 text-black'
            }[slot.keterangan] || 'bg-gray-400 text-white';

            const slotDiv = document.createElement('div');
            slotDiv.className = `w-full aspect-square rounded flex items-center justify-center text-xs cursor-pointer hover:opacity-80 ${colorClasses}`;
            slotDiv.title = `Slot ${slot.nomor_slot} (${slot.keterangan})`;
            slotDiv.textContent = slot.nomor_slot;

            slotGrid.appendChild(slotDiv);
        });

        if (data.slotStats) {
            document.getElementById('tersediaCount').textContent = data.slotStats.tersedia;
            document.getElementById('terisiCount').textContent = data.slotStats.terisi;
            document.getElementById('diperbaikiCount').textContent = data.slotStats.perbaikan;
        }
    }
</script>
