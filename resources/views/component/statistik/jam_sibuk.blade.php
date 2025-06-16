<div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-500 hover:shadow-xl">
    <div class="p-5">
        <div class="flex items-center mb-4">
            <div class="p-3 mr-4 rounded-lg bg-gradient-to-br bg-blue-100 text-blue-600">
                <i class="fas fa-clock text-xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-800">Analisis Jam Sibuk Parkir</h2>
                <p class="text-sm text-gray-500">Waktu dengan kepadatan kendaraan tertinggi</p>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-4 mb-4">
            <div class="bg-gradient-to-r from-red-50 to-orange-50 p-4 rounded-xl border border-red-100 h-full">
                <div class="flex h-full">
                    <div class="flex-1 flex flex-col justify-start">
                        <div class="flex items-center mb-2">
                            <div class="p-2 mr-3 bg-red-100 rounded-lg text-red-600">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <h3 class="font-semibold text-gray-800">Hari Terpadat</h3>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-800">{{ implode(' & ', $hariTersibuk) }}</p>
                            <p class="text-sm text-gray-500">
                                Jumlah penggunaan lahan parkir pada hari {{ implode(' & ', $hariTersibuk) }} adalah sebanyak {{ $totalParkirHariTersibuk }} kendaraan.
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center pl-4">
                        <span class="flex items-center px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-xs font-medium whitespace-nowrap">
                            <i class="fas fa-chart-line mr-1"></i> Puncak
                        </span>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-red-50 to-orange-50 p-4 rounded-xl border border-red-100 h-full">
                <div class="flex h-full">
                    <div class="flex-1 flex flex-col justify-start">
                        <div class="flex items-center mb-2">
                            <div class="p-2 mr-3 bg-red-100 rounded-lg text-red-600">
                                <i class="fas fa-fire-alt"></i>
                            </div>
                            <h3 class="font-semibold text-gray-800">Jam Puncak</h3>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-800">{{ $jamTersibuk }}</p>
                            <p class="text-sm text-gray-500">
                                Rata-rata waktu kendaraan terparkir adalah selama {{ $durasiFormat }}.
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center pl-4">
                        <span class="flex items-center px-3 py-1 bg-red-100 text-red-600 rounded-full text-xs font-medium animate-pulse whitespace-nowrap">
                            <i class="fas fa-exclamation-triangle mr-1"></i> Sibuk
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
            <div class="flex items-center justify-between mb-3">
                <h3 class="font-semibold text-gray-800 flex items-center">
                    <i class="fas fa-calendar-week mr-2 text-blue-500"></i>
                    Detail Jam Sibuk per Hari
                </h3>
            </div>

            <div class="space-y-3">
                @foreach ($jamSibuk as $hari => $jamList)
                    <div class="group flex items-center p-2 hover:bg-white rounded-lg transition-colors duration-200">
                        <span class="font-medium w-24 text-gray-700 flex-shrink-0">{{ __($hari) }}</span>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($jamList as $slot => $jumlah)
                                @php
                                    $warna = 'gray-100 text-gray-700';
                                    if ($jumlah >= 10) $warna = 'red-100 text-red-600';
                                    elseif ($jumlah >= 7) $warna = 'orange-100 text-orange-600';
                                    elseif ($jumlah >= 4) $warna = 'yellow-100 text-yellow-600';
                                    else $warna = 'blue-100 text-blue-600';
                                @endphp
                                <span class="px-2 py-1 bg-{{ $warna }} rounded-full text-xs font-medium">
                                    {{ $slot }} ({{ $jumlah }} kendaraan)
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>


            <div class="mt-4 pt-3 border-t border-gray-200 flex items-center">
                <div class="flex items-center mr-4">
                    <span class="w-3 h-3 bg-red-500 rounded-full mr-1"></span>
                    <span class="text-xs text-gray-600">Sangat Sibuk</span>
                </div>
                <div class="flex items-center mr-4">
                    <span class="w-3 h-3 bg-orange-400 rounded-full mr-1"></span>
                    <span class="text-xs text-gray-600">Sibuk</span>
                </div>
                <div class="flex items-center mr-4">
                    <span class="w-3 h-3 bg-yellow-400 rounded-full mr-1"></span>
                    <span class="text-xs text-gray-600">Agak Sibuk</span>
                </div>
                <div class="flex items-center">
                    <span class="w-3 h-3 bg-blue-400 rounded-full mr-1"></span>
                    <span class="text-xs text-gray-600">Normal</span>
                </div>
            </div>
        </div>

        <div class="mt-4 bg-indigo-50 rounded-lg p-3 border border-indigo-100">
            <p class="text-sm text-indigo-800 flex items-start">
                <i class="fas fa-lightbulb mr-2 mt-1 text-indigo-500"></i>
                <span><span class="font-medium">Tips:</span> Untuk pengalaman parkir lebih nyaman, hindari jam-jam sibuk atau datang 30 menit lebih awal.</span>
            </p>
        </div>
    </div>
</div>
