@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="mb-6 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg border border-blue-200"
            data-aos="fade-down">
            <p class="text-lg text-gray-700"><span class="font-semibold text-indigo-700">Welcome,</span>
                {{ Auth::user()->name }}! 👋</p>
        </div>
        <div class="flex justify-between items-center mb-8" data-aos="fade-down">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Data Pembelian</h1>
                <p class="text-gray-600 mt-1">Kelola semua transaksi pembelian inventory</p>
            </div>
            @can('admin')
                <a href="{{ route('pembelian.create') }}"
                    class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-blue-600 text-white rounded-lg hover:shadow-lg transition-all">
                    <i class="fas fa-plus mr-2"></i>Tambah Pembelian
                </a>
            @endcan
        </div>

        <div class="bg-white shadow-lg rounded-lg overflow-hidden" data-aos="fade-up">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-indigo-50 to-blue-50 border-b-2 border-indigo-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-indigo-700 uppercase tracking-widest">#
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-indigo-700 uppercase tracking-widest">
                                Tanggal</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-indigo-700 uppercase tracking-widest">User
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-indigo-700 uppercase tracking-widest">
                                Total Item</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-indigo-700 uppercase tracking-widest">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($pembelians as $pembelian)
                            <tr class="hover:bg-indigo-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-indigo-600">
                                    {{ \Carbon\Carbon::parse($pembelian->tanggal)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                                        {{ $pembelian->user->name ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-700">
                                    <span class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-xs font-bold">
                                        {{ $pembelian->details->sum('jumlah') }} item
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('pembelian.show', $pembelian) }}"
                                            class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-lg hover:bg-indigo-200 transition-all text-xs font-semibold">
                                            <i class="fas fa-eye mr-1"></i>Detail
                                        </a>
                                        @can('admin')
                                            @if($pembelian->status === 'pending')
                                                <a href="{{ route('pembelian.edit', $pembelian) }}"
                                                    class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 transition-all text-xs font-semibold">
                                                    <i class="fas fa-edit mr-1"></i>Edit
                                                </a>
                                                <form action="{{ route('pembelian.destroy', $pembelian) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-3 py-1 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-all text-xs font-semibold"
                                                        onclick="return confirm('Yakin hapus data ini?')">
                                                        <i class="fas fa-trash mr-1"></i>Hapus
                                                    </button>
                                                </form>
                                            @else
                                                <span class="px-3 py-1 bg-gray-100 text-gray-500 rounded-lg text-xs font-semibold">
                                                    Terkunci
                                                </span>
                                            @endif
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="fas fa-inbox text-4xl mb-3 text-gray-300"></i>
                                        <p class="text-lg font-semibold">Tidak ada data pembelian</p>
                                        <p class="text-sm mt-1">Silakan tambahkan pembelian baru untuk memulai</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection