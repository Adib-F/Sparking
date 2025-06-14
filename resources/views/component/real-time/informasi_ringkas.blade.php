<div id="zona-slot-wrapper" class="p-6 bg-white shadow-2xl rounded-2xl border border-gray-100 transition-all duration-300 hover:shadow-3xl">
    <div class="flex items-center justify-between mb-6">
        <h2 class="flex items-center text-2xl font-bold text-gray-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
            </svg>
            Informasi Ringkas Zona
        </h2>
    </div>

    @php
        $zoneColors = [
            'from-blue-500 to-blue-600',
            'from-green-500 to-green-600',
            'from-purple-500 to-purple-600',
            'from-amber-500 to-amber-600',
            'from-rose-500 to-rose-600',
            'from-emerald-500 to-emerald-600',
            'from-indigo-500 to-indigo-600',
            'from-cyan-500 to-cyan-600'
        ];

        $zones = $zonas ?? [];
        $zoneCount = count($zones);
    @endphp

    @if($zoneCount > 0)
        <div id="zona-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
            @foreach ($zones as $index => $zone)
                @php
                    $available = $zone->available ?? 0;
                    $total = $zone->total ?? 0;
                    $percentage = $total > 0 ? round(($available / $total) * 100) : 0;
                    $colorIndex = $index % count($zoneColors);
                    $bgClass = $zoneColors[$colorIndex];
                @endphp
                <div id="zona-{{ $zone->id }}" class="relative overflow-hidden bg-gradient-to-br {{ $bgClass }} p-5 rounded-xl shadow-md text-white transform transition-all duration-300 hover:scale-[1.03] hover:shadow-xl group">
                    <div class="absolute top-0 right-0 w-16 h-16 -mr-5 -mt-5 rounded-full opacity-20 group-hover:opacity-30 transition-opacity duration-300"></div>
                    <div class="relative z-10">
                        <div class="flex items-start justify-between">
                            <h3 class="text-xl font-bold truncate">{{ $zone->nama_zona ?? 'Zona ' . ($index + 1) }}</h3>
                            <span id="percentage-zona-{{ $zone->id }}" class="px-2 py-1 text-xs font-bold bg-white bg-opacity-20 rounded-full">{{ $percentage }}%</span>
                        </div>
                        <div class="mt-4">
                            <p class="text-sm opacity-90">Slot Tersedia</p>
                            <div class="flex items-end justify-between mt-1">
                                <span id="available-zona-{{ $zone->id }}" class="text-3xl font-bold">{{ $available }}</span>
                                <span id="total-zona-{{$zone->id}}" class="text-sm opacity-80">/{{ $total }} total</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="py-12 text-center bg-gray-50 rounded-xl">
            <div class="relative inline-block mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 mx-auto text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="absolute inset-0 bg-gradient-to-br from-white to-transparent opacity-60 rounded-full"></div>
            </div>
            <h3 class="text-xl font-medium text-gray-600">Tidak ada data zona tersedia</h3>
            <p class="max-w-md mx-auto mt-2 text-gray-500">Admin belum menambahkan zona, silahkan tambahkan zona terlebih dahulu</p>
        </div>
    @endif
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Fungsi untuk memperbarui UI setiap zona
        function updateUI(zonaId, tersedia, total) {
        const availableEl = document.getElementById(`available-zona-${zonaId}`);
        const percentageEl = document.getElementById(`percentage-zona-${zonaId}`);
        const totalEl = document.getElementById(`total-zona-${zonaId}`);

        if (!availableEl || !percentageEl || !totalEl) {
            console.warn(`Elemen untuk zona ${zonaId} belum lengkap di DOM.`);
            return;
        }

        const percentage = total === 0 ? 0 : Math.round((tersedia / total) * 100);

        availableEl.textContent = tersedia;
        percentageEl.textContent = percentage + "%";
        totalEl.textContent = `/${total} total`;

        console.log(`Updating zona ${zonaId}: tersedia = ${tersedia}, total = ${total}, persentase = ${percentage}%`);
    }


    // Fungsi polling untuk update realtime data zona
    function realtimeUpdate() {
    fetch("/api/zona-slot")
        .then(response => response.json())
        .then(data => {
        data.forEach(zona => {
            updateUI(zona.id, zona.tersedia, zona.total);
        });
        })
        .catch(err => {
        console.error("Gagal mengambil data zona:", err);
        });
    }

    // Mulai polling setiap 5 detik setelah halaman siap
    realtimeUpdate(); // Update pertama saat load
    setInterval(realtimeUpdate, 5000);
    });
</script>
