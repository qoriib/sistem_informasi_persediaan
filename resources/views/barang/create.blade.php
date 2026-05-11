@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-8" data-aos="fade-up">
            <h2 class="text-2xl font-bold mb-6 text-indigo-700">Tambah Sparepart</h2>
            <form action="{{ route('barang.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Kode Sparepart</label>
                        <input type="text" name="kode"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="Contoh: BR001" required>
                        @error('kode')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Nama Sparepart</label>
                        <input type="text" name="nama"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="Nama Sparepart" required>
                        @error('nama')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Kategori</label>
                        <select name="kategori_barang_id"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            required>
                            <option value="">Pilih Kategori</option>
                            @foreach($kategoriBarangs as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                            @endforeach
                        </select>
                        @error('kategori_barang_id')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Stok</label>
                        <input type="number" name="stok"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="0" value="0" required min="0">
                        @error('stok')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">ROP</label>
                        <input type="number" name="rop"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="5" value="5" required min="0">
                        @error('rop')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="flex justify-end gap-2 mt-8 pt-6 border-t">
                    <a href="{{ route('barang.index') }}"
                        class="px-5 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-all">Batal</a>
                    <button type="submit"
                        class="px-5 py-2 bg-gradient-to-r from-indigo-500 to-blue-600 text-white rounded-lg hover:shadow-lg transition-all">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection