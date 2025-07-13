@extends('layout.mainUser')

@section('main')
<div class="container px-4 py-8 mx-auto max-w-7xl">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('dashboard') }}" class="flex items-center text-black hover:text-blue-800">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back
        </a>
    </div>

    <!-- Header Section -->
    <div class="flex flex-col items-center justify-between mb-8 md:flex-row">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Parking Space Monitoring</h1>
            <p class="mt-2 text-gray-600">Current status of parking spaces</p>
        </div>
        <div class="flex items-center mt-4 space-x-2 md:mt-0">
            <span class="text-sm font-medium text-gray-500">Last updated:</span>
            <span id="lastUpdated" class="text-sm font-medium text-gray-700">Just now</span>
        </div>
    </div>

    <!-- Rest of your existing content remains the same -->
    <!-- Subzone Photo Section -->
    <div class="mb-8">
        <div class="relative overflow-hidden bg-gray-100 shadow-lg rounded-xl aspect-video">
            <img id="subzonePhoto" class="object-contain w-full h-full bg-white" src="" alt="Subzone Photo">
            <div class="absolute inset-0 flex items-center justify-center" id="photoLoading">
                <div class="w-12 h-12 border-4 border-blue-500 rounded-full border-t-transparent animate-spin"></div>
            </div>
        </div>
        <h3 id="subzoneName" class="mt-4 text-xl font-semibold text-center text-gray-700">Loading subzone information...</h3>
    </div>

    <!-- Parking Grid Section -->
    <div class="p-6 mb-8 bg-white shadow-md rounded-xl">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-gray-800">Parking Space Layout</h2>
            <div class="flex space-x-2">
                <div class="flex items-center px-3 py-1 text-xs bg-blue-100 rounded-full">
                    <div class="w-2 h-2 mr-1 bg-blue-500 rounded-full"></div>
                    <span>Available</span>
                </div>
                <div class="flex items-center px-3 py-1 text-xs bg-red-100 rounded-full">
                    <div class="w-2 h-2 mr-1 bg-red-500 rounded-full"></div>
                    <span>Occupied</span>
                </div>
                <div class="flex items-center px-3 py-1 text-xs bg-yellow-100 rounded-full">
                    <div class="w-2 h-2 mr-1 bg-yellow-400 rounded-full"></div>
                    <span>Maintenance</span>
                </div>
            </div>
        </div>

        <div class="p-4 rounded-lg bg-gray-50">
            <div class="grid grid-cols-10 gap-3" id="slotGrid"></div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-3">
        <div class="p-6 bg-white shadow-md rounded-xl">
            <div class="flex items-center">
                <div class="p-3 mr-4 rounded-full bg-blue-50">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Available Spaces</p>
                    <p class="text-3xl font-bold text-blue-600" id="tersediaCount">0</p>
                </div>
            </div>
        </div>

        <div class="p-6 bg-white shadow-md rounded-xl">
            <div class="flex items-center">
                <div class="p-3 mr-4 rounded-full bg-red-50">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Occupied Spaces</p>
                    <p class="text-3xl font-bold text-red-600" id="terisiCount">0</p>
                </div>
            </div>
        </div>

        <div class="p-6 bg-white shadow-md rounded-xl">
            <div class="flex items-center">
                <div class="p-3 mr-4 rounded-full bg-yellow-50">
                    <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Under Maintenance</p>
                    <p class="text-3xl font-bold text-yellow-500" id="diperbaikiCount">0</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Refresh Button -->
    <div class="flex justify-center">
        <button onclick="loadRealtimeData()" class="flex items-center px-6 py-3 text-white transition duration-300 bg-blue-600 rounded-lg shadow hover:bg-blue-700">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
            Refresh Data
        </button>
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
        // Show loading state
        document.getElementById('photoLoading').classList.remove('hidden');
        document.getElementById('subzonePhoto').classList.add('opacity-50');

        fetch("{{ route('public.realtime.data') }}")
            .then(response => response.json())
            .then(data => {
                // Update timestamp
                updateTimestamp();

                // Update subzone info
                document.getElementById('subzoneName').innerText = data.subzone.nama;
                const photoImg = document.getElementById('subzonePhoto');
                photoImg.src = data.subzone.foto_url;
                photoImg.onload = () => {
                    photoImg.classList.remove('opacity-50');
                    document.getElementById('photoLoading').classList.add('hidden');
                };

                // Update parking grid
                const slotGrid = document.getElementById('slotGrid');
                slotGrid.innerHTML = '';

                let tersedia = 0, terisi = 0, perbaikan = 0;

                data.slots.forEach(slot => {
                    const slotDiv = document.createElement('div');
                    slotDiv.className = 'relative group';

                    const statusDot = document.createElement('div');
                    statusDot.className = 'w-8 h-8 rounded-lg transition-all duration-300';

                    // Tooltip
                    const tooltip = document.createElement('div');
                    tooltip.className = 'absolute z-10 invisible px-3 py-1 text-xs text-white bg-gray-800 rounded-md group-hover:visible bottom-full mb-2';
                    tooltip.textContent = `Slot #${slot.nomor} - ${slot.status.charAt(0).toUpperCase() + slot.status.slice(1)}`;

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

                // Update counters
                document.getElementById('tersediaCount').textContent = tersedia;
                document.getElementById('terisiCount').textContent = terisi;
                document.getElementById('diperbaikiCount').textContent = perbaikan;
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                document.getElementById('photoLoading').classList.add('hidden');
                document.getElementById('subzonePhoto').classList.remove('opacity-50');
            });
    }

    // Initial load
    document.addEventListener('DOMContentLoaded', () => {
        loadRealtimeData();
        // Auto-refresh every 15 seconds
        setInterval(loadRealtimeData, 15000);
    });
</script>
@endpush
