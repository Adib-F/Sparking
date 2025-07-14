@extends('layout.mainUser')

@section('main')
    <div class="container px-4 py-8 mx-auto max-w-7xl">
        <!-- Tombol Kembali -->
        <div class="mb-6">
            <a href="{{ route('login') }}" class="flex items-center text-black hover:text-blue-800">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali
            </a>
        </div>

        <!-- Header -->
        <div class="flex flex-col items-center justify-between mb-8 md:flex-row">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Pemantauan Slot Parkir</h1>
                <p class="mt-2 text-gray-600">Status terkini tempat parkir</p>
            </div>
            <div class="flex items-center mt-4 space-x-2 md:mt-0">
                <span class="text-sm font-medium text-gray-500">Terakhir diperbarui:</span>
                <span id="lastUpdated" class="text-sm font-medium text-gray-700">Baru saja</span>
            </div>
        </div>

        <!-- Gambar Subzona -->
        <div class="mb-8">
            <div
                class="relative overflow-hidden bg-gray-100 shadow-lg rounded-xl w-full h-[300px] md:h-[450px] lg:h-[550px]">
                <img src="{{ asset('data_parkir/subzona/4.1.jpg') }}" class="object-cover w-full h-full bg-white"
                    alt="Foto Subzona">
            </div>
            <h3 class="mt-4 text-xl font-semibold text-center text-gray-700">Subzona 3.2</h3>
        </div>


        <!-- Grid Slot Parkir -->
        <div class="p-6 mb-8 bg-white shadow-md rounded-xl">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-800">Tata Slot Tempat Parkir</h2>
                <div class="flex space-x-2">
                    <div class="flex items-center px-3 py-1 text-xs bg-blue-100 rounded-full">
                        <div class="w-2 h-2 mr-1 bg-blue-500 rounded-full"></div>
                        <span>Tersedia</span>
                    </div>
                    <div class="flex items-center px-3 py-1 text-xs bg-red-100 rounded-full">
                        <div class="w-2 h-2 mr-1 bg-red-500 rounded-full"></div>
                        <span>Terisi</span>
                    </div>
                    <div class="flex items-center px-3 py-1 text-xs bg-yellow-100 rounded-full">
                        <div class="w-2 h-2 mr-1 bg-yellow-400 rounded-full"></div>
                        <span>Perbaikan</span>
                    </div>
                </div>
            </div>

            <div class="p-4 rounded-lg bg-gray-50">
                <div class="grid grid-cols-10 gap-3" id="slotGrid"></div>
            </div>
        </div>

        <!-- Statistik Slot -->
        <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-3">
            <div class="p-6 bg-white shadow-md rounded-xl">
                <div class="flex items-center">
                    <div class="p-3 mr-4 rounded-full bg-blue-50">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Slot Tersedia</p>
                        <p class="text-3xl font-bold text-blue-600" id="tersediaCount">0</p>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-white shadow-md rounded-xl">
                <div class="flex items-center">
                    <div class="p-3 mr-4 rounded-full bg-red-50">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Slot Terisi</p>
                        <p class="text-3xl font-bold text-red-600" id="terisiCount">0</p>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-white shadow-md rounded-xl">
                <div class="flex items-center">
                    <div class="p-3 mr-4 rounded-full bg-yellow-50">
                        <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Dalam Perbaikan</p>
                        <p class="text-3xl font-bold text-yellow-500" id="diperbaikiCount">0</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function updateTimestamp() {
            const now = new Date();
            const timeString = now.toLocaleTimeString();
            document.getElementById('lastUpdated').textContent = timeString;
        }

        function loadRealtimeData() {
            fetch("{{ route('public.realtime.data') }}")
                .then(response => response.json())
                .then(data => {
                    updateTimestamp();

                    // Update slot grid
                    const slotGrid = document.getElementById('slotGrid');
                    slotGrid.innerHTML = '';

                    let tersedia = 0,
                        terisi = 0,
                        perbaikan = 0;

                    data.slots.forEach(slot => {
                        const slotDiv = document.createElement('div');
                        slotDiv.className = 'relative group';

                        const statusDot = document.createElement('div');
                        statusDot.className = 'w-8 h-8 rounded-lg transition-all duration-300';

                        const tooltip = document.createElement('div');
                        tooltip.className =
                            'absolute z-10 invisible px-3 py-1 text-xs text-white bg-gray-800 rounded-md group-hover:visible bottom-full mb-2';
                        tooltip.textContent = `Slot #${slot.nomor} - ${slot.status}`;

                        if (slot.status === 'available') {
                            statusDot.classList.add('bg-blue-500', 'hover:bg-blue-600');
                            tersedia++;
                        } else if (slot.status === 'occupied') {
                            statusDot.classList.add('bg-red-500', 'hover:bg-red-600');
                            terisi++;
                        } else {
                            statusDot.classList.add('bg-yellow-400', 'hover:bg-yellow-500');
                            perbaikan++;
                        }

                        slotDiv.appendChild(statusDot);
                        slotDiv.appendChild(tooltip);
                        slotGrid.appendChild(slotDiv);
                    });

                    document.getElementById('tersediaCount').textContent = tersedia;
                    document.getElementById('terisiCount').textContent = terisi;
                    document.getElementById('diperbaikiCount').textContent = perbaikan;
                })
                .catch(error => {
                    console.error('Gagal mengambil data:', error);
                });
        }

        document.addEventListener('DOMContentLoaded', () => {
            loadRealtimeData();
            setInterval(loadRealtimeData, 15000); // refresh otomatis tiap 15 detik
        });
    </script>
@endpush
