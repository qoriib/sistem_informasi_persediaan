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
                <h1 class="text-3xl font-bold text-gray-800">Kategori Sparepart</h1>
                <p class="text-gray-600 mt-1">Kelola kategori untuk setiap item inventory</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('kategori-barang.export.pdf') }}"
                    class="px-4 py-2 border border-indigo-300 text-indigo-700 rounded-lg hover:bg-indigo-50 transition-all">
                    Export PDF
                </a>
                <a href="{{ route('kategori-barang.create') }}"
                    class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-blue-600 text-white rounded-lg hover:shadow-lg transition-all">
                    <i class="fas fa-plus mr-2"></i>Tambah Kategori
                </a>
            </div>
        </div>

        <div class="bg-white shadow-lg rounded-lg overflow-hidden" data-aos="fade-up">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-indigo-50 to-blue-50 border-b-2 border-indigo-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-indigo-700 uppercase tracking-widest">#
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-indigo-700 uppercase tracking-widest">Nama
                                Kategori</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-indigo-700 uppercase tracking-widest">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($kategoriBarangs as $kategori)
                            <tr class="hover:bg-indigo-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-indigo-600">
                                    {{ $kategori->nama }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('kategori-barang.edit', $kategori) }}"
                                            class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-lg hover:bg-indigo-200 transition-all text-xs font-semibold">
                                            <i class="fas fa-edit mr-1"></i>Edit
                                        </a>
                                        <form action="{{ route('kategori-barang.destroy', $kategori) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-all text-xs font-semibold"
                                                onclick="return confirm('Yakin hapus data ini?')">
                                                <i class="fas fa-trash mr-1"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="fas fa-inbox text-4xl mb-3 text-gray-300"></i>
                                        <p class="text-lg font-semibold">Tidak ada kategori</p>
                                        <p class="text-sm mt-1">Silakan tambahkan kategori baru untuk memulai</p>
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