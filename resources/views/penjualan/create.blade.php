@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-8" data-aos="fade-up">
            <h2 class="text-2xl font-bold mb-6 text-indigo-700">Tambah Penjualan</h2>
            <form action="{{ route('penjualan.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ date('Y-m-d') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        required>
                    @error('tanggal')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Sparepart (Ctrl/Cmd untuk pilih multiple)</label>
                    <select name="barang_id[]"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        multiple required>
                        @foreach($barangs as $barang)
                            <option value="{{ $barang->id }}">{{ $barang->nama }} (Stok: {{ $barang->stok }})</option>
                        @endforeach
                    </select>
                    <p class="text-gray-500 text-sm mt-1">Tekan Ctrl (Windows) / Cmd (Mac) untuk memilih lebih dari satu
                        sparepart.</p>
                    @error('barang_id')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Jumlah per Sparepart</label>
                    <input type="text" name="jumlah" placeholder="Contoh: 2,1,5 (urut sesuai sparepart)"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        required>
                    <p class="text-gray-500 text-sm mt-1">Pisahkan jumlah dengan koma, urut sesuai sparepart yang dipilih.
                    </p>
                    @error('jumlah')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
                </div>
                <div class="flex justify-end gap-2 mt-8 pt-6 border-t">
                    <a href="{{ route('penjualan.index') }}"
                        class="px-5 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-all">Batal</a>
                    <button type="submit"
                        class="px-5 py-2 bg-gradient-to-r from-indigo-500 to-blue-600 text-white rounded-lg hover:shadow-lg transition-all">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection