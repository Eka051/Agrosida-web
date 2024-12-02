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
            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-semibold mb-1">Username</label>
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
                <a href="#" class="text-green-500 text-base font-semibold hover:underline">Lupa Password?</a>
            </div>
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

            <button type="submit" 
                    class="w-full mt-4 bg-green-500 text-white p-3 text-lg rounded-lg font-medium hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">
                Login
            </button>
            <div class="text-center mt-3">
                <p class="text-lg">Belum memiliki akun? <a href="{{ route('register') }}"
                        class="text-greenPrimary font-semibold hover:underline hover:text-greenSecondary focus:outline-none focus:underline">Register</a>
                </p>
            </div>
        </form>
    </div>
</div>

@if ($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Login Gagal',
        text: '{{ $errors->first() }}',
        confirmButtonColor: '#A2E554',
        confirmButtonText: 'OK'
    });
</script>
@endif
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Pendaftaran Berhasil',
        text: '{{ session('success') }}',
        confirmButtonColor: '#A2E554',
        confirmButtonText: 'OK'
    });
</script>
@endif

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
