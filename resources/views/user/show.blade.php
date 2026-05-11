@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden" data-aos="fade-up">
            <div class="bg-gradient-to-r from-indigo-500 to-blue-600 px-8 py-6">
                <h2 class="text-2xl font-bold text-white">Detail User</h2>
            </div>

            <div class="p-8 space-y-6">
                <div class="border-b pb-4">
                    <p class="text-gray-600 text-sm">Nama Lengkap</p>
                    <p class="text-2xl font-bold text-indigo-700">{{ $user->name }}</p>
                </div>

                <div class="border-b pb-4">
                    <p class="text-gray-600 text-sm">Email</p>
                    <p class="text-lg text-gray-800">{{ $user->email }}</p>
                </div>

                <div class="border-b pb-4">
                    <p class="text-gray-600 text-sm">Role</p>
                    <div>
                        @if($user->role === 'admin_sparepart')
                            <span
                                class="inline-block bg-purple-100 text-purple-800 px-4 py-2 rounded-full text-sm font-semibold">
                                Admin Spare Part
                            </span>
                        @else
                            <span class="inline-block bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-semibold">
                                Service Manager
                            </span>
                        @endif
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-8 pt-6 border-t">
                    <a href="{{ route('user.index') }}"
                        class="px-5 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-all">Kembali</a>
                    <a href="{{ route('user.edit', $user) }}"
                        class="px-5 py-2 bg-gradient-to-r from-indigo-500 to-blue-600 text-white rounded-lg hover:shadow-lg transition-all">Edit</a>
                </div>
            </div>
        </div>
    </div>
@endsection