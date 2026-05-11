@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="mb-6 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg border border-blue-200"
            data-aos="fade-down">
            <p class="text-lg text-gray-700"><span class="font-semibold text-indigo-700">Welcome,</span>
                {{ Auth::user()->name }}! 👋</p>
        </div>
        <div class="flex justify-between items-center mb-8" data-aos="fade-down">
            <h2 class="text-2xl font-bold text-indigo-700">Dashboard</h2>
            <span class="text-gray-500">{{ date('d M Y') }}</span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-br from-blue-500 to-indigo-600 shadow-lg rounded-lg p-6 flex flex-col items-center"
                data-aos="zoom-in">
                <div class="text-3xl font-bold text-white mb-2">{{ $totalBarang }}</div>
                <div class="text-white">Total Sparepart</div>
            </div>
            <div class="bg-gradient-to-br from-green-400 to-green-600 shadow-lg rounded-lg p-6 flex flex-col items-center"
                data-aos="zoom-in" data-aos-delay="100">
                <div class="text-3xl font-bold text-white mb-2">{{ $totalPenjualan }}</div>
                <div class="text-white">Total Penjualan</div>
            </div>
            <div class="bg-gradient-to-br from-yellow-400 to-yellow-600 shadow-lg rounded-lg p-6 flex flex-col items-center"
                data-aos="zoom-in" data-aos-delay="200">
                <div class="text-3xl font-bold text-white mb-2">{{ $totalPembelian }}</div>
                <div class="text-white">Total Pembelian</div>
            </div>
        </div>
        @if(count($barangHabis) > 0)
            <div class="mb-8">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert"
                    data-aos="fade-up">
                    <strong class="font-bold">Perhatian!</strong>
                    <span class="block sm:inline">Ada {{ count($barangHabis) }} sparepart yang stoknya di bawah ROP:</span>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach($barangHabis as $barang)
                            <li>
                                {{ $barang->nama }} (Stok: {{ $barang->stok }}, ROP : {{ $barang->rop }})
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <div class="bg-white shadow-lg rounded-lg p-6" data-aos="fade-up">
            <h2 class="text-xl font-bold mb-4 text-indigo-700">Grafik Stok Sparepart (Top 5 Terendah)</h2>
            <canvas id="stokChart" height="100"></canvas>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('stokChart').getContext('2d');
        const stokChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($topBarangLabels) !!},
                datasets: [{
                    label: 'Stok',
                    data: {!! json_encode($topBarangStok) !!},
                    backgroundColor: 'rgba(59, 130, 246, 0.7)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
@endsection