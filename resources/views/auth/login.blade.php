@extends('components.navbar')
@extends('components.template')
@section('title', 'Login - AGROSIDA')
@section('content')

<div class="flex flex-col items-center justify-center min-h-screen bg-gradient-to-br from-green-400 to-green-600 px-4">
    <!-- Header Section -->
    <div class="text-center text-white mb-8">
        <h1 class="text-4xl font-bold">Selamat Datang di AGROSIDA</h1>
        <p class="text-lg mt-2">Website untuk kalkulasi penggunaan pestisida dan marketplace pestisida.</p>
    </div>

    <!-- Login Form Section -->
    <div class="bg-white shadow-lg rounded-lg w-full max-w-md p-6">
        <h2 class="text-2xl font-bold text-center mb-4">Login</h2>
        <form action="{{ route('login.authenticate') }}" method="POST">
            @csrf
            <!-- Username Input -->
            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-semibold mb-1">Username</label>
                <input type="text" name="username" id="username" placeholder="Masukkan username" 
                       class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" required>
                @error('username')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Input -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-semibold mb-1">Password</label>
                <input type="password" name="password" id="password" placeholder="Masukkan password" 
                       class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" required>
                @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="h-4 w-4 text-green-400 focus:ring-green-400 border-gray-300 rounded">
                    <span class="ml-2 text-gray-600">Ingat saya</span>
                </label>
                <a href="#" class="text-green-500 text-sm hover:underline">Lupa Password?</a>
            </div>

            <!-- Login Button -->
            <button type="submit" 
                    class="w-full bg-green-500 text-white p-3 rounded-lg font-medium hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">
                Login
            </button>
        </form>

        <!-- Divider -->
        <div class="flex items-center my-4">
            <hr class="flex-grow border-gray-300">
            <span class="text-gray-500 mx-2">atau</span>
            <hr class="flex-grow border-gray-300">
        </div>

        <!-- Google OAuth -->
        <a href="{{ route('oauth.google') }}" 
           class="w-full bg-white border border-gray-300 text-gray-700 p-3 rounded-lg flex items-center justify-center hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-green-400">
            <span class="iconify mr-2 text-xl" data-icon="logos:google"></span>
            Masuk dengan Google
        </a>

        <!-- Register Link -->
        <div class="text-center mt-6">
            <p class="text-sm">Belum memiliki akun? 
                <a href="/register" class="text-green-500 font-semibold hover:underline">Register</a>
            </p>
        </div>
    </div>
</div>

<!-- SweetAlert Error Notification -->
@if ($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Login Gagal',
        text: 'Username atau password salah. Silakan coba lagi.',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
    });
</script>
@endif

@endsection
