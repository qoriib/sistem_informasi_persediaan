@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-8" data-aos="fade-up">
            <h2 class="text-2xl font-bold mb-6 text-indigo-700">Edit Penjualan</h2>
            <form action="{{ route('penjualan.update', $penjualan) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ date('Y-m-d', strtotime($penjualan->tanggal)) }}"
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
                            {{-- Check jika barang sudah ada di penjualan --}}
                            <option value="{{ $barang->id }}"
                                @if($penjualan->details->pluck('barang_id')->contains($barang->id)) selected @endif>
                                {{ $barang->nama }} (Stok: {{ $barang->stok }})
                            </option>
                        @endforeach
                    </select>
                    <p class="text-gray-500 text-sm mt-1">Tekan Ctrl (Windows) / Cmd (Mac) untuk memilih lebih dari satu
                        sparepart.</p>
                    @error('barang_id')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Jumlah per Sparepart</label>
                    <input type="text" name="jumlah"
                        value="{{ $penjualan->details->sortBy('barang_id')->pluck('jumlah')->implode(',') }}"
                        placeholder="Contoh: 2,1,5 (urut sesuai sparepart)"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        required>
                    <p class="text-gray-500 text-sm mt-1">Pisahkan jumlah dengan koma, urut sesuai sparepart yang dipilih.
                    </p>
                    @error('jumlah')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
                </div>

                {{-- Tampilkan detail penjualan saat ini --}}
                @if($penjualan->details->count() > 0)
                    <div class="mt-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                        <h3 class="font-semibold text-blue-900 mb-3">Detail Penjualan Saat Ini</h3>
                        <div class="space-y-2">
                            @foreach($penjualan->details as $detail)
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-gray-700">{{ $detail->barang->nama }}</span>
                                    <span class="font-semibold text-blue-700">{{ $detail->jumlah }} item</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="flex justify-end gap-2 mt-8 pt-6 border-t">
                    <a href="{{ route('penjualan.index') }}"
                        class="px-5 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-all">Batal</a>
                    <button type="submit"
                        class="px-5 py-2 bg-gradient-to-r from-indigo-500 to-blue-600 text-white rounded-lg hover:shadow-lg transition-all">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
@endsection