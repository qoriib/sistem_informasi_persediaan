@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-8" data-aos="fade-up">
            <h2 class="text-2xl font-bold mb-6 text-indigo-700">Tambah User Baru</h2>
            <form action="{{ route('user.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        required autofocus>
                    @error('name')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        required>
                    @error('email')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Password</label>
                    <input type="password" name="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        required minlength="8">
                    <p class="text-gray-500 text-sm mt-1">Minimal 8 karakter</p>
                    @error('password')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        required minlength="8">
                    @error('password_confirmation')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Role</label>
                    <select name="role"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        required>
                        <option value="">-- Pilih Role --</option>
                        @foreach($roles as $key => $label)
                            <option value="{{ $key }}" @if(old('role') === $key) selected @endif>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    <div class="mt-3 p-3 bg-blue-50 rounded border border-blue-200">
                        <p class="text-sm text-blue-800">
                            <strong>Admin Spare Part:</strong> Kelola sparepart, kategori sparepart, pembelian<br>
                            <strong>Service Manager:</strong> Catat penjualan, setujui pembelian
                        </p>
                    </div>
                    @error('role')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
                </div>

                <div class="flex justify-end gap-2 mt-8 pt-6 border-t">
                    <a href="{{ route('user.index') }}"
                        class="px-5 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-all">Batal</a>
                    <button type="submit"
                        class="px-5 py-2 bg-gradient-to-r from-indigo-500 to-blue-600 text-white rounded-lg hover:shadow-lg transition-all">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection