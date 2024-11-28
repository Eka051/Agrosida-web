@extends('components.navbar')
@extends('components.template')
@section('title', 'Register')
@section('content')

{{-- <style>
    @keyframes rotate-bounce {
        0% {
            transform: scale(0.3) rotate(0deg);
        }

        50% {
            transform: scale(1.2) rotate(195deg);
        }

        100% {
            transform: scale(0.3) rotate(0deg);
        }
    }

    .rotate-bounce-animation {
        animation: rotate-bounce 2s ease-in-out infinite;
    }

    @keyframes rotate {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    .rotate-animation {
        animation: rotate 5s linear infinite;
    }
</style> --}}
<form action="{{ route('register.storeSeller') }}" method="POST">
    @csrf
    <div class="mt-20">
        <div class="flex items-center justify-center">
            <div class="flex flex-col items-center w-1/2 mr-20 ml-8">
                <div class="block mt-6">
                    <p class="text-4xl text-black font-semibold w-[50rem]">
                        Create an account to continue
                        <span class="block">your journey of website exploration and unlock exclusive features tailored
                            just for you.</span>
                    <p class="text-white mt-4 text-lg">Designed by: Dian Eka Raharjo</p>
                    <img src="{{ asset('img/burst-bloat.svg') }}" alt="burst-bloat"
                        class="-z-10 top-0 right-4 w-14 rotate-bounce-animation" style="transform: scale(0.502668);">
                    </p>
                </div>
                <div class="relative w-full flex justify-center">
                    <img src="{{ asset('img/signup-1.png') }}" alt="Login Illustration" class="w-3/5 relative">
                    <img src="{{ asset('img/gear.png') }}" alt="gear"
                        class="w-[15%] absolute bottom-0 right-0 rotate-animation">
                </div>
            </div>
            <div class="bg-gradient-to-t from-greenPrimary to-greenSecondary w-[70rem] h-screen ml-6">
                <div class="bg-white shadow-lg border border-gray-200 w-[30rem] h-[45rem] rounded-xl m-auto mt-28">
                    <p class="text-[30px] font-bold text-center pt-8">Register</p>
                    <div class="px-16 mt-8">
                        <div>
                            <label for="name" class="block font-semibold text-lg">Nama Lengkap</label>
                            <input type="text" name="name" id="name" placeholder="Masukkan nama lengkap" autofocus
                                required
                                class="w-[22rem] h-10 rounded-lg border border-gray-300 bg-gray-100 pl-4 focus:outline-gray-200 focus:bg-white">
                            @error('name')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="username" class="block font-semibold text-lg">Username</label>
                            <input type="text" name="username" id="username" placeholder="Masukkan username" autofocus
                                required
                                class="w-[22rem] h-10 rounded-lg border border-gray-300 bg-gray-100 pl-4 focus:outline-gray-200 focus:bg-white">
                            @error('username')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="password" class="block font-semibold text-lg">Password</label>
                            <input type="password" name="password" id="password" placeholder="Masukkan password"
                                autofocus required
                                class="w-[22rem] h-10 rounded-lg border border-gray-300 bg-gray-100 pl-4 focus:outline-gray-200 focus:bg-white">
                            @error('password')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="passwod_confirmation" class="block font-semibold text-lg">Konfirmasi
                                Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                placeholder="Konfirmasi password" autofocus required
                                class="w-[22rem] h-10 rounded-lg border border-gray-300 bg-gray-100 pl-4 focus:outline-gray-200 focus:bg-white">
                            @error('password_confirmation')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-8 flex justify-center">
                            <button type="submit"
                                class="bg-greenSecondary from-greenPrimary w-[22rem] h-12 text-white text-lg font-medium rounded-lg hover:bg-blue-700 hover:text-white focus:outline-none focus:bg-blue-700">Register</button>
                        </div>
                        <div class="mt-4 flex items-center justify-center space-x-2">
                            <div class="w-[40%] border-t border-gray-300"></div>
                            <span class="text-gray-500">atau</span>
                            <div class="w-[40%] border-t border-gray-300"></div>
                        </div>
                        <div class="mt-4 flex justify-center">
                            <a href="{{ route('oauth.google') }}"
                                class="w-[22rem] h-12 bg-white border border-gray-300 text-lg font-medium rounded-lg hover:bg-gray-100 flex items-center justify-center focus:outline-gray-400">
                                <span class="text-2xl iconify ml-2 mr-[0.5rem]" data-icon="devicon:google"></span>
                                Daftar dengan Google
                            </a>
                        </div>
                        <div class="text-center mt-8">
                            <p class="text-lg">Sudah memiliki akun? <a href="/login"
                                    class="text-blue-400 font-semibold hover:underline focus:outline-none focus:underline">Login</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</form>

@endsection