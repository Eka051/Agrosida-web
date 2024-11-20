@extends('components.template')
@section('title', 'Login')
@section('content')

<form action="{{ route('login.authenticate') }}" method="POST">
    @csrf
    <div class="mt-20">
        <div class="flex justify-center m-auto">
            <div class="flex bg-gradient-to-t from-greenPrimary to-greenSecondary w-[70rem] h-screen flex-col items-center justify-center">
                <div class="block mb-8 ml-8">
                    <p class="text-4xl text-white font-semibold">
                        Login to your account
                        <span class="block">to explore the website, connect with others, and enhance your experience.</span>
                        <p class="text-white mt-4 text-lg">Designed by: Dian Eka Raharjo</p>
                    </p>
                </div>
                <img src="{{ asset('img/login-1.png') }}" alt="Login Illustration" class="w-3/5">
            </div>

            <div class="bg-white shadow-lg border border-gray-200 w-[30rem] h-[38rem] rounded-xl m-auto mt-32">
                <p class="text-[30px] font-bold text-center pt-8">Login</p>
                <div class="px-16 mt-12">
                    <div>
                        <label for="username" class="block font-semibold text-lg">Username</label>
                        <input type="text" name="username" id="username" placeholder="Masukkan username" autofocus required class="w-[22rem] h-10 rounded-lg border border-gray-300 bg-gray-100 pl-4 focus:outline-gray-200 focus:bg-white">
                    </div>
                    <div class="mt-4">
                        <label for="password" class="block font-semibold text-lg">Password</label>
                        <input type="password" name="password" id="password" placeholder="Masukkan password" required class="w-[22rem] h-10 rounded-lg border border-gray-300 bg-gray-100 pl-4 focus:outline-gray-200 focus:bg-white">
                    </div>
                    <div class="mt-2 flex items-center justify-between">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="text-greenPrimary from-greenPrimary rounded">
                            <span class="ml-2 text-gray-600">Ingat saya</span>
                        </label>

                        <a href="#" class="text-greenPrimary font-semibold focus:outline-none focus:underline hover:underline">Lupa Password?</a>
                    </div>
                    <div class="mt-4 flex justify-center">
                        <button type="submit" class="bg-greenSecondary from-greenPrimary w-[22rem] h-12 text-white text-lg font-medium rounded-lg hover:bg-blue-700 hover:text-white focus:outline-none focus:bg-blue-700">Login</button>
                    </div>
                    <div class="mt-4 flex items-center justify-center space-x-2">
                        <div class="w-[40%] border-t border-gray-300"></div>
                        <span class="text-gray-500">atau</span>
                        <div class="w-[40%] border-t border-gray-300"></div>
                    </div>
                    <div class="mt-4 flex justify-center">
                        <a href="{{ route('oauth.google') }}" class="w-[22rem] h-12 bg-white border border-gray-300 text-lg font-medium rounded-lg hover:bg-gray-100 flex items-center justify-center focus:outline-gray-400">
                            <span class="text-2xl iconify ml-2 mr-[0.5rem]" data-icon="devicon:google"></span>
                            <span class="icon-[devicon--google]" style="width: 1.2rem; height: 1.2rem;"></span>
                            Masuk dengan Google
                        </a>
                    </div>
                    <div class="text-center mt-8">
                        <p class="text-lg">Belum memiliki akun? <a href="/register" class="text-blue-400 font-semibold hover:underline focus:outline-none focus:underline">Register</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection
