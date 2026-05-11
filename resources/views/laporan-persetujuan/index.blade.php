@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="mb-6 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg border border-blue-200"
            data-aos="fade-down">
            <p class="text-lg text-gray-700"><span class="font-semibold text-indigo-700">Welcome,</span>
                {{ Auth::user()->name }}! 👋</p>
        </div>
        @if (session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded" data-aos="fade-down">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-8" data-aos="fade-down">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Laporan Persetujuan Pembelian</h1>
                <p class="text-gray-600 mt-1">Kelola dan pantau semua transaksi pembelian untuk persetujuan</p>
            </div>
            <a href="{{ route('laporan-persetujuan.export.pdf') }}"
                class="px-4 py-2 border border-indigo-300 text-indigo-700 rounded-lg hover:bg-indigo-50 transition-all">
                Export PDF
            </a>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white shadow-lg rounded-lg p-6" data-aos="zoom-in">
                <div class="flex items-center">
                    <div class="bg-gradient-to-br from-indigo-100 to-blue-100 p-4 rounded-lg">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-600 text-sm font-semibold uppercase">Total Pembelian</p>
                        <p class="text-3xl font-bold text-indigo-700">{{ $totalPembelian }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-lg rounded-lg p-6" data-aos="zoom-in" data-aos-delay="100">
                <div class="flex items-center">
                    <div class="bg-gradient-to-br from-yellow-100 to-orange-100 p-4 rounded-lg">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-600 text-sm font-semibold uppercase">Menunggu Persetujuan</p>
                        <p class="text-3xl font-bold text-yellow-700">{{ $pendingPembelian }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-lg rounded-lg p-6" data-aos="zoom-in" data-aos-delay="200">
                <div class="flex items-center">
                    <div class="bg-gradient-to-br from-blue-100 to-indigo-100 p-4 rounded-lg">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-600 text-sm font-semibold uppercase">Total Item</p>
                        <p class="text-3xl font-bold text-blue-700">{{ $totalItemPembelian }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Approval Table -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden" data-aos="fade-up">
            <div class="bg-gradient-to-r from-indigo-50 to-blue-50 px-8 py-6 border-b-2 border-indigo-200">
                <h3 class="text-xl font-bold text-indigo-700">Daftar Pembelian untuk Persetujuan</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">#</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Tanggal
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">User
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Items
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($pembelians as $pembelian)
                            <tr class="hover:bg-indigo-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $pembelians->firstItem() + $loop->index }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-indigo-600">
                                    {{ \Carbon\Carbon::parse($pembelian->tanggal)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                                        {{ $pembelian->user->name ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-xs font-bold">
                                        {{ $pembelian->details->sum('jumlah') }} item
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @php
                                        $statusClass = match ($pembelian->status) {
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'diproses' => 'bg-blue-100 text-blue-800',
                                            'diterima' => 'bg-green-100 text-green-800',
                                            'ditolak' => 'bg-red-100 text-red-800',
                                            default => 'bg-gray-100 text-gray-800'
                                        };
                                        $statusText = match ($pembelian->status) {
                                            'pending' => 'Menunggu',
                                            'diproses' => 'Diproses',
                                            'diterima' => 'Diterima',
                                            'ditolak' => 'Ditolak',
                                            default => 'Unknown'
                                        };
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $statusClass }}">
                                        {{ $statusText }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('pembelian.show', $pembelian) }}"
                                            class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-lg hover:bg-indigo-200 transition-all text-xs font-semibold">
                                            <i class="fas fa-eye mr-1"></i>Lihat
                                        </a>

                                        @can('manager')
                                            @if($pembelian->status === 'pending')
                                                <button onclick="openApprovalModal({{ $pembelian->id }})"
                                                    class="px-3 py-1 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-all text-xs font-semibold">
                                                    <i class="fas fa-check mr-1"></i>Proses
                                                </button>
                                            @endif
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="fas fa-inbox text-4xl mb-3 text-gray-300"></i>
                                        <p class="text-lg font-semibold">Tidak ada data pembelian</p>
                                        <p class="text-sm mt-1">Semua pembelian telah selesai atau belum ada data</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($pembelians->hasPages())
                <div class="bg-gray-50 px-8 py-6 flex justify-center">
                    {{ $pembelians->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Approval Modal -->
    <div id="approvalModal"
        class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center overflow-y-auto"
        onclick="closeApprovalModal(event)">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-2xl my-8" onclick="event.stopPropagation()">
            <h3 class="text-xl font-bold mb-6 text-indigo-700">Persetujuan Pembelian</h3>

            <!-- Detail Pembelian -->
            <div class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                <h4 class="font-semibold text-gray-800 mb-4">Detail Pengajuan</h4>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-600">Tanggal Pengajuan</p>
                        <p id="modal-tanggal" class="font-semibold text-gray-800">-</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Pengaju</p>
                        <p id="modal-user" class="font-semibold text-gray-800">-</p>
                    </div>
                </div>
                <div class="mt-3">
                    <p class="text-gray-600 text-sm">Deskripsi</p>
                    <p id="modal-deskripsi" class="text-gray-800 text-sm mt-1">-</p>
                </div>
                <div class="mt-3">
                    <p class="text-gray-600 text-sm">Keterangan</p>
                    <p id="modal-keterangan" class="text-gray-800 text-sm mt-1">-</p>
                </div>
                <div class="mt-3" id="modal-file-section">
                    <p class="text-gray-600 text-sm">File Pendukung</p>
                    <p id="modal-file" class="text-indigo-600 text-sm mt-1">-</p>
                </div>
            </div>

            <form id="approvalForm" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Status Persetujuan</label>
                    <select name="status"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        required>
                        <option value="">-- Pilih Status --</option>
                        <option value="diproses">Diproses</option>
                        <option value="diterima">Diterima</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Catatan Persetujuan (Opsional)</label>
                    <textarea name="notes" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                </div>

                <div class="flex justify-end gap-2 pt-4 border-t">
                    <button type="button" onclick="closeApprovalModal()"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-all">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-blue-600 text-white rounded-lg hover:shadow-lg transition-all">Kirim
                        Persetujuan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openApprovalModal(pembelianId) {
            // Fetch pembelian data via AJAX to populate modal
            fetch(`/api/pembelian/${pembelianId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('modal-tanggal').textContent = new Date(data.tanggal).toLocaleDateString('id-ID');
                    document.getElementById('modal-user').textContent = data.user.name;
                    document.getElementById('modal-deskripsi').textContent = data.deskripsi || '-';
                    document.getElementById('modal-keterangan').textContent = data.keterangan || '-';

                    if (data.file_path) {
                        document.getElementById('modal-file').innerHTML = `<a href="/storage/${data.file_path}" target="_blank" class="underline font-semibold">📎 Unduh File</a>`;
                    } else {
                        document.getElementById('modal-file').textContent = 'Tidak ada file';
                    }
                });

            const form = document.getElementById('approvalForm');
            form.action = `/laporan-persetujuan/${pembelianId}/approve`;
            document.getElementById('approvalModal').classList.remove('hidden');
        }

        function closeApprovalModal(event) {
            if (event && event.target.id !== 'approvalModal') return;
            document.getElementById('approvalModal').classList.add('hidden');
        }
    </script>
@endsection