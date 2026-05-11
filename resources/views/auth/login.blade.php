<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Persediaan Suku Cadang</title>
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
                <i class="fas fa-boxes text-3xl text-indigo-700"></i>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Persediaan</h1>
            <p class="text-indigo-100">Masuk ke Sistem Informasi Persediaan Suku Cadang</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <!-- Session Status -->
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-circle text-red-600 mr-3 mt-1"></i>
                        <div>
                            <h3 class="font-semibold text-red-800 mb-2">Login Gagal</h3>
                            @foreach ($errors->all() as $error)
                                <p class="text-red-700 text-sm">{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email Address -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2" for="email">
                        <i class="fas fa-envelope mr-2 text-indigo-600"></i>Email
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                        placeholder="nama@example.com" required autofocus>
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
                    @error('password')
                        <span class="text-red-500 text-sm mt-1 block"><i class="fas fa-times-circle"></i>
                            {{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember"
                            class="w-4 h-4 text-indigo-600 rounded focus:ring-indigo-500">
                        <span class="ml-2 text-gray-700 text-sm">Ingat saya</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-indigo-600 hover:text-indigo-800 text-sm font-semibold transition">
                            Lupa password?
                        </a>
                    @endif
                </div>

                <!-- Login Button -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-indigo-500 to-blue-600 text-white font-bold py-3 rounded-lg hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-sign-in-alt mr-2"></i>Masuk
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

                <!-- Register Link -->
                <p class="text-center text-gray-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}"
                        class="text-indigo-600 font-bold hover:text-indigo-800 transition">
                        Daftar di sini
                    </a>
                </p>
            </form>

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