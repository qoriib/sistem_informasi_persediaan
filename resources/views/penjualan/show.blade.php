@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-3xl mx-auto" data-aos="fade-up">
            <div class="bg-white shadow-lg rounded-lg p-8 mb-6">
                <div class="flex justify-between items-start mb-6 pb-6 border-b">
                    <div>
                        <h2 class="text-3xl font-bold text-indigo-700">Detail Penjualan</h2>
                        <p class="text-gray-600 mt-1">Informasi lengkap transaksi penjualan</p>
                    </div>
                    <a href="{{ route('penjualan.index') }}"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-all">
                        <i class="fas fa-arrow-left mr-1"></i>Kembali
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-gradient-to-br from-indigo-50 to-blue-50 p-4 rounded-lg">
                        <p class="text-gray-600 text-sm font-semibold uppercase tracking-wider">Tanggal</p>
                        <p class="text-xl font-bold text-indigo-700 mt-1">
                            {{ \Carbon\Carbon::parse($penjualan->tanggal)->format('d/m/Y') }}</p>
                    </div>
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-4 rounded-lg">
                        <p class="text-gray-600 text-sm font-semibold uppercase tracking-wider">User</p>
                        <p class="text-xl font-bold text-blue-700 mt-1">{{ $penjualan->user->name ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-50 to-blue-50 px-8 py-6 border-b-2 border-indigo-200">
                    <h3 class="text-xl font-bold text-indigo-700">Sparepart Terjual</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">#
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Nama Sparepart</th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Jumlah</th>
                                <th class="px-6 py-4 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Harga</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($penjualan->details as $detail)
                                <tr class="hover:bg-indigo-50 transition-colors">
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 text-sm font-semibold text-indigo-600">
                                        {{ $detail->barang->nama ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-center text-gray-700">
                                        <span class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full font-semibold">
                                            {{ $detail->jumlah }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold text-right text-gray-900">Rp
                                        {{ number_format($detail->harga, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="bg-gradient-to-r from-indigo-50 to-blue-50 px-8 py-6 text-right border-t-2 border-indigo-200">
                    <p class="text-sm text-gray-600">Total Item: <span
                            class="font-bold text-indigo-700">{{ $penjualan->details->sum('jumlah') }}</span></p>
                </div>
            </div>
        </div>
    </div>
@endsection