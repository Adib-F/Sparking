@extends('layout.mainUser')
@include('component.headerUser')

@section('main')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 p-4 md:p-8">
    <div class="max-w-4xl mx-auto space-y-6">

        <div class="mb-3 w-max">
            <a href="{{ route('dashboard') }}"
                class="inline-flex items-center bg-white hover:bg-gray-50 border border-gray-200 text-gray-700 px-4 py-2 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-x-0.5">
                <i class="fas fa-arrow-left mr-2 text-gray-500"></i>
                Kembali
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-500 hover:shadow-xl transform hover:-translate-y-1">
            <div class="p-5">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <h2 class="text-xl font-bold text-gray-800 mb-3 md:mb-0 flex items-center">
                        <i class="fas fa-map-marker-alt text-blue-500 mr-3"></i>
                        Pilih Zona Parkir
                    </h2>
                    <select id="zoneSelect"
                        class="px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-white shadow-sm">
                        @foreach ($zonas as $zona)
                            <option value="{{ $zona->id }}">{{ $zona->nama_zona }}</option>
                        @endforeach
                    </select>

                </div>
            </div>
        </div>




        {{-- statistik kendaraan --}}
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-500 hover:shadow-xl">
            <div class="p-5">
                <div class="flex items-center mb-4">
                    <div class="p-3 mr-4 rounded-lg bg-blue-100 text-blue-600">
                        <i class="fas fa-car text-xl"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">Statistik Kendaraan</h2>
                </div>
                <div class="chart-container flex justify-center h-64 md:h-80">
                    <canvas id="vehicleChart"></canvas>
                </div>
                <div class="mt-4 flex justify-center space-x-4">
                    <div class="text-center p-3 bg-blue-50 rounded-lg w-24">
                        <div class="text-2xl font-bold text-blue-600" id="totalVehicles">0</div>
                        <div class="text-xs text-gray-500">Total</div>
                    </div>
                    <div class="text-center p-3 bg-green-50 rounded-lg w-24">
                        <div class="text-2xl font-bold text-green-600" id="peakDay">-</div>
                        <div class="text-xs text-gray-500">Hari Puncak</div>
                    </div>
                    <div class="text-center p-3 bg-yellow-50 rounded-lg w-24">
                        <div class="text-2xl font-bold text-yellow-600" id="avgVehicles">0</div>
                        <div class="text-xs text-gray-500">Rata-rata</div>
                    </div>
                </div>
            </div>
        </div>

        {{--  --}}



        {{-- Jam sibuk --}}
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-500 hover:shadow-xl">
            <div class="p-5">
                <div class="flex items-center mb-4">
                    <div class="p-3 mr-4 rounded-lg bg-blue-100 text-blue-600">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">Jam Sibuk Parkir</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="font-semibold text-gray-800 mb-3 flex items-center">
                            <i class="fas fa-calendar-week mr-2 text-blue-500"></i>
                            Analisis Jam Sibuk per Hari
                        </h3>
                        <ul class="space-y-3">
                            <li class="flex items-start"><span class="font-medium w-24 text-gray-700">Senin</span><span class="text-gray-600">: 08.00, 11.00, 14.00–16.00</span></li>
                            <li class="flex items-start"><span class="font-medium w-24 text-gray-700">Selasa</span><span class="text-gray-600">: 09.00, 11.00</span></li>
                            <li class="flex items-start"><span class="font-medium w-24 text-gray-700">Rabu</span><span class="text-gray-600">: 15.00–17.00</span></li>
                            <li class="flex items-start"><span class="font-medium w-24 text-gray-700">Kamis</span><span class="text-gray-600">: 09.00, 12.00</span></li>
                            <li class="flex items-start"><span class="font-medium w-24 text-gray-700">Jumat</span><span class="text-gray-600">: 19.00–21.00</span></li>
                            <li class="flex items-start"><span class="font-medium w-24 text-gray-700">Sabtu</span><span class="text-gray-600">: 07.00</span></li>
                            <li class="flex items-start"><span class="font-medium w-24 text-gray-700">Minggu</span><span class="text-gray-600">: 12.00</span></li>
                        </ul>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="space-y-2">
                            <div>
                                <div class="flex justify-between text-sm mb-1"><span>08.00-10.00</span><span>72% kepadatan</span></div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-red-500 h-2 rounded-full" style="width: 72%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-1"><span>11.00-13.00</span><span>65% kepadatan</span></div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-orange-500 h-2 rounded-full" style="width: 65%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-1"><span>14.00-16.00</span><span>58% kepadatan</span></div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-yellow-500 h-2 rounded-full" style="width: 58%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--  --}}
    </div>
</div>

    <script>


    document.addEventListener('DOMContentLoaded', function() {
        const firstZonaId = document.getElementById('zoneSelect').value;
        initVehicleChart(firstZonaId);

        document.getElementById('zoneSelect').addEventListener('change', function() {
            const zonaId = this.value;
            initVehicleChart(zonaId);
        });
    });


let vehicleChart = null;

function initVehicleChart(zonaId = 1) {
    fetch(`/api/statistik/${zonaId}`)
    .then(res => res.json())
    .then(data => {
        const ctx = document.getElementById('vehicleChart').getContext('2d');

        if (vehicleChart !== null) {
            vehicleChart.destroy();
        }

                const chartData = {
                    labels: data.labels,
                    datasets: [{
                        label: 'Jumlah Kendaraan',
                        data: data.data,
                        backgroundColor: data.data.map((v, i) =>
                            i === data.labels.indexOf(data.peak_day) ?
                                'rgba(255, 99, 132, 0.7)' :
                                'rgba(0, 204, 255, 0.7)'
                        ),
                        borderColor: data.data.map((v, i) =>
                            i === data.labels.indexOf(data.peak_day) ?
                                'rgba(255, 99, 132, 1)' :
                                'rgba(0, 204, 255, 1)'
                        ),
                        borderWidth: 1,
                        borderRadius: 6
                    }]
                };

                vehicleChart = new Chart(ctx, {
                    type: 'bar',
                    data: chartData,
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return `Jumlah: ${context.parsed.y}`;
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0
                                }
                            }
                        }
                    }
                });

                animateValue('totalVehicles', data.total, 2000);
                animateValue('avgVehicles', data.average, 2000);
                document.getElementById('peakDay').textContent = data.peak_day;
            });
    }

    function animateValue(id, target, duration) {
        const element = document.getElementById(id);
        const increment = target / (duration / 16);
        let current = 0;

        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                clearInterval(timer);
                current = target;
            }
            element.textContent = Math.floor(current);
        }, 16);
    }
</script>

@endsection
