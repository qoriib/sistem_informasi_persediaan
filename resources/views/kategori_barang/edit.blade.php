@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-lg mx-auto bg-white shadow-lg rounded-lg p-8" data-aos="fade-up">
            <h2 class="text-2xl font-bold mb-6 text-indigo-700">Edit Kategori Sparepart</h2>
            <form action="{{ route('kategori-barang.update', $kategoriBarang) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Nama Kategori</label>
                    <input type="text" name="nama" value="{{ $kategoriBarang->nama }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        required>
                    @error('nama')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
                </div>
                <div class="flex justify-end gap-2 mt-8 pt-6 border-t">
                    <a href="{{ route('kategori-barang.index') }}"
                        class="px-5 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-all">Batal</a>
                    <button type="submit"
                        class="px-5 py-2 bg-gradient-to-r from-indigo-500 to-blue-600 text-white rounded-lg hover:shadow-lg transition-all">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection