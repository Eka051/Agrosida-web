@extends('components.navbar')
@extends('components.template')
@section('title', 'Login - AGROSIDA')
@section('content')

<div class="min-h-screen bg-gray-50 flex">

    <!-- Left Section - Image and Info -->
    <div class="hidden lg:flex lg:w-1/2 relative bg-gradient-to-br from-green-400 to-green-600">
        <div class="absolute inset-0 bg-black bg-opacity-30"></div>
        <div class="relative z-10 p-12 text-white flex flex-col justify-center">
            <img src="{{ asset('images/farmer.svg') }}" alt="Farmer Illustration" class="w-3/4 mx-auto mb-8 animate__animated animate__fadeIn">
            <h2 class="text-3xl font-bold mb-4 animate__animated animate__fadeIn animate__delay-1s">Solusi Terbaik untuk Pertanian Anda</h2>
            <ul class="space-y-4">
                <li class="flex items-center animate__animated animate__fadeIn animate__delay-2s">
                    <span class="iconify mr-3 text-lg text-yellow-400" data-icon="carbon:calculator"></span>
                    Kalkulasi dosis pestisida yang tepat dengan mudah
                </li>
                <li class="flex items-center animate__animated animate__fadeIn animate__delay-3s">
                    <span class="iconify mr-3 text-lg text-yellow-400" data-icon="mdi:store"></span>
                    Marketplace pestisida terpercaya dengan pilihan lengkap
                </li>
                <li class="flex items-center animate__animated animate__fadeIn animate__delay-4s">
                    <span class="iconify mr-3 text-lg text-yellow-400" data-icon="carbon:agriculture"></span>
                    Didukung oleh para ahli pertanian untuk solusi terbaik
                </li>
            </ul>
        </div>
    </div>

    <!-- Right Section - Login Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
        <div class="w-full max-w-md">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Selamat Datang di AGROSIDA</h1>
                <p class="text-gray-600 mt-2">Masuk untuk mengakses layanan kami yang memudahkan pertanian Anda</p>
            </div>

            <div class="bg-white shadow-lg rounded-lg p-8">
                <form action="{{ route('login.authenticate') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="username" class="block text-gray-700 font-semibold mb-1">Username/Email</label>
                        <input type="text" name="username" id="username" placeholder="Masukkan username atau email" 
                               class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" required>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block font-semibold text-lg">Password</label>
                        <div class="relative">
                            <input type="password" name="password" id="password" placeholder="Masukkan password" required
                                class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                            <span class="absolute right-4 top-3 cursor-pointer toggle-password text-2xl" 
                                  data-target="password" 
                                  data-icon="fluent:eye-24-regular" 
                                  data-icon-hide="fluent:eye-off-24-regular">
                                <span class="iconify" data-icon="fluent:eye-24-regular"></span>
                            </span>
                        </div>
                    </div>

                    <div>
                        <a href="{{ route('password.request') }}" class="text-green-500 text-base font-semibold hover:underline">Lupa Password?</a>
                    </div>

                    <button type="submit" 
                            class="w-full mt-6 bg-green-500 text-white p-3 text-lg rounded-lg font-medium hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">
                        Login
                    </button>

                    <div class="flex items-center my-4">
                        <hr class="flex-grow border-gray-300">
                        <span class="text-gray-500 mx-2">atau</span>
                        <hr class="flex-grow border-gray-300">
                    </div>

                    <a href="{{ route('oauth.google') }}"
                       class="w-full font-medium text-lg bg-white border border-gray-300 text-gray-700 p-3 rounded-lg flex items-center justify-center hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-green-400">
                        <span class="iconify mr-2" data-icon="logos:google-icon" data-width="24" data-height="24"></span>
                        Masuk dengan Google
                    </a>

                    <div class="text-center mt-6">
                        <p class="text-lg">Belum memiliki akun? <a href="{{ route('register') }}"
                                class="text-green-500 font-semibold hover:underline focus:outline-none focus:underline">Daftar sekarang</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.toggle-password').forEach(toggle => {
        toggle.addEventListener('click', () => {
            const targetId = toggle.getAttribute('data-target');
            const target = document.getElementById(targetId);
            const icon = toggle.querySelector('.iconify');
            const iconShow = toggle.getAttribute('data-icon');
            const iconHide = toggle.getAttribute('data-icon-hide');

            if (target.type === 'password') {
                target.type = 'text';
                if (icon) icon.setAttribute('data-icon', iconHide);
            } else {
                target.type = 'password';
                if (icon) icon.setAttribute('data-icon', iconShow);
            }
        });
    });
</script>

@endsection
