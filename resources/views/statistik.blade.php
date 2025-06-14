@extends('layout.mainUser')
@include('component.headerUser')

@section('main')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 p-4 md:p-8">
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
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Statistik Kendaraan</h2>
                        <p class="text-sm text-gray-500">Jumlah penggunaan slot parkir selama satu minggu terakhir</p>
                    </div>

                </div>
                <div class="chart-container flex justify-center h-64 md:h-80">
                    <canvas id="vehicleChart"></canvas>
                </div>
                <div class="mt-4 flex justify-center space-x-4">
                    <div class="text-center p-3 bg-green-50 rounded-lg w-24">
                        <div class="text-2xl font-bold text-green-600" id="totalVehicles">0</div>
                        <div class="text-xs text-gray-500">Total</div>
                    </div>
                    <div class="text-center p-3 bg-red-50 rounded-lg w-24">
                        <div class="text-2xl font-bold text-red-600" id="peakDay">-</div>
                        <div class="text-xs text-gray-500">Hari Puncak</div>
                    </div>
                    <div class="text-center p-3 bg-yellow-50 rounded-lg w-24">
                        <div class="text-2xl font-bold text-yellow-600" id="avgVehicles">0</div>
                        <div class="text-xs text-gray-500">Rata-rata</div>
                    </div>
                </div>
            </div>
        </div>

        @include('component.statistik.jam_sibuk')

    </div>
</div>

<script>
    document.getElementById('zoneSelect').addEventListener('change', function () {
        const zonaId = this.value;

        const chartContainer = document.querySelector('.chart-container');
        chartContainer.innerHTML = `
            <div class="chart-loading flex justify-center items-center h-full">
                <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500"></div>
            </div>`;

        fetch(`/api/statistik-zona?zona_id=${zonaId}`)
            .then(res => res.json())
            .then(data => {
                // Update statistik
                document.getElementById('totalVehicles').innerText = data.total;
                document.getElementById('avgVehicles').innerText = data.avg_per_day;
                document.getElementById('peakDay').innerText = data.hari_terpadat;

                // Kembalikan canvas grafik
                chartContainer.innerHTML = '<canvas id="vehicleChart"></canvas>';
                const ctx = document.getElementById('vehicleChart').getContext('2d');

                if (window.vehicleChartInstance) {
                    window.vehicleChartInstance.destroy();
                }

                const maxValue = Math.max(...data.chart.data);
                const step = Math.ceil(maxValue / 4);

                // Gradient default
                const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                gradient.addColorStop(0, 'rgba(56, 182, 255, 0.8)');
                gradient.addColorStop(1, 'rgba(16, 112, 255, 0.2)');

                const peakDayIndex = data.chart.labels.indexOf(data.hari_terpadat);

                const barColors = data.chart.labels.map((_, idx) =>
                    idx === peakDayIndex ? 'rgba(255, 99, 132, 0.8)' : gradient
                );
                const borderColors = data.chart.labels.map((_, idx) =>
                    idx === peakDayIndex ? 'rgba(255, 99, 132, 1)' : 'rgba(16, 112, 255, 1)'
                );
                const hoverColors = data.chart.labels.map((_, idx) =>
                    idx === peakDayIndex ? 'rgba(255, 99, 132, 1)' : 'rgba(16, 112, 255, 0.9)'
                );

                window.vehicleChartInstance = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.chart.labels,
                        datasets: [{
                            label: 'Jumlah Kendaraan',
                            data: data.chart.data,
                            backgroundColor: barColors,
                            borderColor: borderColors,
                            borderWidth: 2,
                            borderRadius: 6,
                            borderSkipped: false,
                            hoverBackgroundColor: hoverColors,
                            hoverBorderColor: borderColors,
                            hoverBorderWidth: 3
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                titleFont: { size: 14, weight: 'bold' },
                                bodyFont: { size: 13 },
                                padding: 12,
                                cornerRadius: 8,
                                displayColors: false,
                                callbacks: {
                                    label: function (context) {
                                        return ` ${context.parsed.y} kendaraan`;
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)',
                                    drawBorder: false
                                },
                                ticks: {
                                    stepSize: step,
                                    maxTicksLimit: 6,
                                    precision: 0,
                                    color: '#6b7280',
                                    font: { size: 12 }
                                },
                                suggestedMax: maxValue + step
                            },
                            x: {
                                grid: { display: false, drawBorder: false },
                                ticks: {
                                    color: '#6b7280',
                                    font: { size: 12 },
                                    callback: function(value, index, ticks) {
                                        return this.getLabelForValue(value);
                                    }
                                }
                            }
                        },
                        animation: {
                            duration: 1000,
                            easing: 'easeOutQuart'
                        },
                        interaction: {
                            intersect: false,
                            mode: 'index'
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Error:', error);
                chartContainer.innerHTML = `
                    <div class="chart-error text-center py-8 text-red-500 bg-red-100 rounded-lg">
                        Gagal memuat data grafik. Silakan coba lagi.
                    </div>`;
            });
    });

    document.getElementById('zoneSelect').dispatchEvent(new Event('change'));
</script>
@endsection
