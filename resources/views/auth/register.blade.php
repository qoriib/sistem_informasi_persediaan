<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Persediaan Suku Cadang</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
    </style>
</head>

<body class="flex items-center justify-center py-12 px-4">
    <div class="w-full max-w-md" data-aos="fade-up">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-full shadow-lg mb-4">
                <i class="fas fa-user-plus text-3xl text-indigo-700"></i>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Daftar Akun</h1>
            <p class="text-indigo-100">Buat akun baru untuk mengakses sistem</p>
        </div>

        <!-- Register Card -->
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-circle text-red-600 mr-3 mt-1"></i>
                        <div>
                            <h3 class="font-semibold text-red-800 mb-2">Pendaftaran Gagal</h3>
                            @foreach ($errors->all() as $error)
                                <p class="text-red-700 text-sm">{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Full Name -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2" for="name">
                        <i class="fas fa-user mr-2 text-indigo-600"></i>Nama Lengkap
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                        placeholder="John Doe" required autofocus>
                    @error('name')
                        <span class="text-red-500 text-sm mt-1 block"><i class="fas fa-times-circle"></i>
                            {{ $message }}</span>
                    @enderror
                </div>

                <!-- Email Address -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2" for="email">
                        <i class="fas fa-envelope mr-2 text-indigo-600"></i>Email
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                        placeholder="nama@example.com" required>
                    @error('email')
                        <span class="text-red-500 text-sm mt-1 block"><i class="fas fa-times-circle"></i>
                            {{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2" for="password">
                        <i class="fas fa-lock mr-2 text-indigo-600"></i>Password
                    </label>
                    <input type="password" id="password" name="password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                        placeholder="••••••••" required>
                    <p class="text-gray-500 text-xs mt-1">Minimal 8 karakter</p>
                    @error('password')
                        <span class="text-red-500 text-sm mt-1 block"><i class="fas fa-times-circle"></i>
                            {{ $message }}</span>
                    @enderror
                </div>

                <!-- Role -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2" for="role">
                        <i class="fas fa-user-tag mr-2 text-indigo-600"></i>Role
                    </label>
                    <select id="role" name="role"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                        required>
                        <option value="">-- Pilih Role --</option>
                        <option value="admin_sparepart" {{ old('role') == 'admin_sparepart' ? 'selected' : '' }}>Admin Spare Part</option>
                        <option value="service_manager" {{ old('role') == 'service_manager' ? 'selected' : '' }}>Service Manager</option>
                    </select>
                    <p class="text-gray-500 text-xs mt-1">Pilih role sesuai tugas Anda</p>
                    @error('role')
                        <span class="text-red-500 text-sm mt-1 block"><i class="fas fa-times-circle"></i>
                            {{ $message }}</span>
                    @enderror
                </div>

                <!-- Password Confirmation -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2" for="password_confirmation">
                        <i class="fas fa-lock mr-2 text-indigo-600"></i>Konfirmasi Password
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                        placeholder="••••••••" required>
                    @error('password_confirmation')
                        <span class="text-red-500 text-sm mt-1 block"><i class="fas fa-times-circle"></i>
                            {{ $message }}</span>
                    @enderror
                </div>

                <!-- Terms & Conditions -->
                <div class="flex items-start">
                    <input type="checkbox" id="agree" class="w-4 h-4 text-indigo-600 rounded focus:ring-indigo-500 mt-1"
                        required>
                    <label for="agree" class="ml-2 text-gray-700 text-sm">
                        Saya setuju dengan <a href="#"
                            class="text-indigo-600 hover:text-indigo-800 font-semibold">syarat & ketentuan</a>
                    </label>
                </div>

                <!-- Register Button -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-indigo-500 to-blue-600 text-white font-bold py-3 rounded-lg hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-user-check mr-2"></i>Daftar Sekarang
                </button>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-gray-500 text-sm">
                        <span class="px-2 bg-white">atau</span>
                    </div>
                </div>

                <!-- Login Link -->
                <p class="text-center text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-indigo-600 font-bold hover:text-indigo-800 transition">
                        Masuk di sini
                    </a>
                </p>
            </form>

            <!-- Features Box -->
            <div class="mt-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                <p class="text-blue-800 text-sm font-semibold mb-2">
                    <i class="fas fa-check-circle mr-2"></i>Keuntungan Mendaftar:
                </p>
                <ul class="text-blue-700 text-xs space-y-1">
                    <li><i class="fas fa-check mr-1"></i>Akses sistem inventory terintegrasi</li>
                    <li><i class="fas fa-check mr-1"></i>Dashboard analytics real-time</li>
                    <li><i class="fas fa-check mr-1"></i>Sistem approval otomatis</li>
                </ul>
            </div>
        </div>

        <!-- Footer Link -->
        <div class="text-center mt-6">
            <a href="/" class="text-white hover:text-indigo-100 transition">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Beranda
            </a>
        </div>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });
    </script>
</body>

</html>