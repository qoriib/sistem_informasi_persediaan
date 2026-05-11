<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Persediaan Suku Cadang') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f3f4f6 0%, #e0e7ff 100%);
        }

        .sidebar {
            background: #fff;
        }

        .sidebar a {
            color: #4b5563;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background: #f0f4f8;
            color: #4f46e5;
            font-weight: 600;
        }
    </style>
</head>

<body class="min-h-screen flex">
    <aside class="sidebar w-64 min-h-screen p-6 flex flex-col shadow-lg">
        <div class="mb-8 text-center">
            <span class="text-2xl font-bold text-indigo-700 tracking-wide">Persediaan</span>
        </div>
        <nav class="flex-1">
            <ul class="space-y-2">
                <li><a href="{{ route('dashboard') }}"
                        class="block py-2 px-4 rounded transition-all {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                        data-aos="fade-right">Dashboard</a></li>
                <li><a href="{{ route('kategori-barang.index') }}"
                        class="block py-2 px-4 rounded transition-all {{ request()->routeIs('kategori-barang.*') ? 'active' : '' }}"
                        data-aos="fade-right" data-aos-delay="50">Kategori Sparepart</a></li>
                <li><a href="{{ route('barang.index') }}"
                        class="block py-2 px-4 rounded transition-all {{ request()->routeIs('barang.*') ? 'active' : '' }}"
                        data-aos="fade-right" data-aos-delay="100">Sparepart</a></li>
                <li><a href="{{ route('penjualan.index') }}"
                        class="block py-2 px-4 rounded transition-all {{ request()->routeIs('penjualan.*') ? 'active' : '' }}"
                        data-aos="fade-right" data-aos-delay="150">Penjualan</a></li>
                <li><a href="{{ route('pembelian.index') }}"
                        class="block py-2 px-4 rounded transition-all {{ request()->routeIs('pembelian.*') ? 'active' : '' }}"
                        data-aos="fade-right" data-aos-delay="200">Pembelian</a></li>
                <li><a href="{{ route('laporan-persetujuan.index') }}"
                        class="block py-2 px-4 rounded transition-all {{ request()->routeIs('laporan-persetujuan.*') ? 'active' : '' }}"
                        data-aos="fade-right" data-aos-delay="250">Laporan Persetujuan</a></li>
                @can('admin')
                    <li><a href="{{ route('user.index') }}"
                            class="block py-2 px-4 rounded transition-all {{ request()->routeIs('user.*') ? 'active' : '' }}"
                            data-aos="fade-right" data-aos-delay="300">Manajemen User</a></li>
                @endcan
            </ul>
        </nav>
        <div class="mt-8 text-center">
            @auth
                <span class="block text-gray-700 mb-2 font-medium">{{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition-all">Logout</button>
                </form>
            @endauth
        </div>
    </aside>
    <main class="flex-1 p-8" style="min-height:100vh;">
        @yield('content')
    </main>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });
    </script>
</body>

</html>