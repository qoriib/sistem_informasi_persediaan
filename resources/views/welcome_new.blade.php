<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Persediaan Suku Cadang') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f3f4f6 0%, #e0e7ff 100%);
        }
    </style>
</head>

<body class="min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg p-4 sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-2xl font-bold text-indigo-700 tracking-wide">
                <i class="fas fa-boxes mr-2"></i>Persediaan
            </div>
            <div class="space-x-4">
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="px-6 py-2 bg-gradient-to-r from-indigo-500 to-blue-600 text-white rounded-lg hover:shadow-lg transition-all">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="px-6 py-2 text-indigo-700 hover:bg-indigo-50 rounded-lg transition-all">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                        class="px-6 py-2 bg-gradient-to-r from-indigo-500 to-blue-600 text-white rounded-lg hover:shadow-lg transition-all">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="container mx-auto px-4 py-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center" data-aos="fade-up">
            <div>
                <h1 class="text-5xl font-bold text-gray-800 mb-4 leading-tight">
                    Kelola Persediaan <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-600">Suku
                        Cadang</span> Dengan Mudah
                </h1>
                <p class="text-xl text-gray-600 mb-8">
                    Sistem informasi terintegrasi untuk mengelola inventaris sparepart, pembelian, penjualan, dan
                    persetujuan dengan role-based access control.
                </p>
                <div class="flex gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="px-8 py-3 bg-gradient-to-r from-indigo-500 to-blue-600 text-white rounded-lg hover:shadow-lg transition-all font-semibold">
                            Buka Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}"
                            class="px-8 py-3 bg-gradient-to-r from-indigo-500 to-blue-600 text-white rounded-lg hover:shadow-lg transition-all font-semibold">
                            Daftar Sekarang
                        </a>
                        <a href="{{ route('login') }}"
                            class="px-8 py-3 border-2 border-indigo-500 text-indigo-700 rounded-lg hover:bg-indigo-50 transition-all font-semibold">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
            <div class="relative" data-aos="fade-left" data-aos-delay="200">
                <div
                    class="w-full h-96 bg-gradient-to-br from-indigo-400 to-blue-600 rounded-2xl shadow-2xl flex items-center justify-center">
                    <div class="text-center">
                        <i class="fas fa-box text-white text-7xl mb-4"></i>
                        <p class="text-white text-lg font-semibold">Manajemen Inventory Modern</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-white py-20">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center text-gray-800 mb-16" data-aos="fade-up">
                Fitur Unggulan
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-gradient-to-br from-indigo-50 to-blue-50 p-8 rounded-xl shadow-lg hover:shadow-2xl transition-all"
                    data-aos="fade-up">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-cube text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Manajemen Sparepart</h3>
                    <p class="text-gray-600">Kelola kategori sparepart dan data sparepart dengan mudah. Pantau stok
                        real-time
                        dan informasi lengkap untuk setiap item.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-8 rounded-xl shadow-lg hover:shadow-2xl transition-all"
                    data-aos="fade-up" data-aos-delay="100">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-shopping-cart text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Penjualan & Pembelian</h3>
                    <p class="text-gray-600">Catat transaksi penjualan dan pembelian dengan detail lengkap. Sistem
                        terintegrasi untuk approval dan dokumentasi.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-8 rounded-xl shadow-lg hover:shadow-2xl transition-all"
                    data-aos="fade-up" data-aos-delay="200">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-check-circle text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Sistem Persetujuan</h3>
                    <p class="text-gray-600">Alur persetujuan otomatis dengan notifikasi ROP (Reorder Point). Manager
                        dapat menyetujui atau menolak pembelian dengan catatan.</p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-gradient-to-br from-yellow-50 to-orange-50 p-8 rounded-xl shadow-lg hover:shadow-2xl transition-all"
                    data-aos="fade-up" data-aos-delay="300">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-file-upload text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Unggah Dokumen</h3>
                    <p class="text-gray-600">Lampirkan file pendukung untuk setiap pembelian. Aman menyimpan dokumen
                        dengan tipe file yang terbatas.</p>
                </div>

                <!-- Feature 5 -->
                <div class="bg-gradient-to-br from-red-50 to-rose-50 p-8 rounded-xl shadow-lg hover:shadow-2xl transition-all"
                    data-aos="fade-up" data-aos-delay="400">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-red-500 to-rose-600 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Manajemen User</h3>
                    <p class="text-gray-600">Kelola akun pengguna dengan role berbeda. Admin Spare Part dan Service
                        Manager dengan permission terpisah.</p>
                </div>

                <!-- Feature 6 -->
                <div class="bg-gradient-to-br from-cyan-50 to-blue-50 p-8 rounded-xl shadow-lg hover:shadow-2xl transition-all"
                    data-aos="fade-up" data-aos-delay="500">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-chart-line text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Dashboard & Laporan</h3>
                    <p class="text-gray-600">Visualisasi data real-time dengan dashboard interaktif. Laporan persetujuan
                        untuk monitoring alur bisnis.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Roles Section -->
    <section class="py-20">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center text-gray-800 mb-16" data-aos="fade-up">
                Sistem Permission Berbasis Role
            </h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Admin Role -->
                <div class="bg-white rounded-2xl shadow-xl p-8 border-t-4 border-purple-600" data-aos="fade-up">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-shield-alt text-purple-600 text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">Admin Spare Part</h3>
                    </div>
                    <p class="text-gray-600 mb-6">Memiliki akses penuh untuk mengelola sistem</p>
                    <ul class="space-y-3">
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            Kelola kategori sparepart dan sparepart
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            Buat dan edit pembelian
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            Lihat laporan persetujuan
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            Kelola data user
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            Akses dashboard analytics
                        </li>
                    </ul>
                </div>

                <!-- Manager Role -->
                <div class="bg-white rounded-2xl shadow-xl p-8 border-t-4 border-green-600" data-aos="fade-up"
                    data-aos-delay="200">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-user-tie text-green-600 text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">Service Manager</h3>
                    </div>
                    <p class="text-gray-600 mb-6">Akses terbatas untuk operasional harian</p>
                    <ul class="space-y-3">
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            Buat penjualan
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            Lihat pembelian (read-only)
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            Setujui/Tolak pembelian
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            Lihat dashboard
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-times text-red-500 mr-3"></i>
                            Tidak bisa kelola user
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-gradient-to-r from-indigo-600 to-blue-600 py-20">
        <div class="container mx-auto px-4 text-center" data-aos="zoom-in">
            <h2 class="text-4xl font-bold text-white mb-6">Siap Untuk Mulai?</h2>
            <p class="text-xl text-indigo-100 mb-8 max-w-2xl mx-auto">
                Bergabunglah dengan sistem manajemen persediaan modern kami dan tingkatkan efisiensi bisnis Anda.
            </p>
            @auth
                <a href="{{ route('dashboard') }}"
                    class="px-8 py-3 bg-white text-indigo-600 rounded-lg hover:shadow-lg transition-all font-bold text-lg">
                    Buka Dashboard
                </a>
            @else
                <a href="{{ route('register') }}"
                    class="px-8 py-3 bg-white text-indigo-600 rounded-lg hover:shadow-lg transition-all font-bold text-lg inline-block mr-4">
                    Daftar Gratis
                </a>
                <a href="{{ route('login') }}"
                    class="px-8 py-3 border-2 border-white text-white rounded-lg hover:bg-white hover:bg-opacity-10 transition-all font-bold text-lg inline-block">
                    Masuk
                </a>
            @endauth
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <h4 class="text-white font-bold mb-4">Tentang</h4>
                    <p class="text-sm">Sistem informasi persediaan suku cadang yang modern dan user-friendly.</p>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4">Fitur</h4>
                    <ul class="text-sm space-y-2">
                        <li><a href="#" class="hover:text-white transition">Manajemen Inventory</a></li>
                        <li><a href="#" class="hover:text-white transition">Sistem Approval</a></li>
                        <li><a href="#" class="hover:text-white transition">Dashboard Analytics</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4">Kontak</h4>
                    <p class="text-sm">Email: support@persediaan.local</p>
                    <p class="text-sm">Phone: +62 (0) xxx-xxx-xxx</p>
                </div>
            </div>
            <div class="border-t border-gray-700 pt-8 text-center text-sm">
                <p>&copy; 2026 Sistem Informasi Persediaan. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });
    </script>
</body>

</html>