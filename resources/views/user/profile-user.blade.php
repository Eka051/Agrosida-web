@extends('components.template')
@section('title', 'Profil')
@section('content')

<div class="container mx-auto px-4 py-8 mt-20">
    <div class="max-w-4xl mx-auto space-y-8">
        {{-- Profile Header --}}
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Biodata Diri</h1>
        </div>

        {{-- Profile Form --}}
        <div class="bg-white shadow-xl rounded-2xl p-6 border border-gray-100">
            <form action="{{ route('user.dashboard') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="block space-y-6">
                    {{-- Profile Photo --}}
                    {{-- <div class="col-span-2">
                        <label for="photo" class="block text-base font-medium text-gray-700 mb-2">Foto Profil</label>
                        <div class="flex items-center space-x-6">
                            <img class="w-24 h-24 rounded-full" src="https://via.placeholder.com/100" alt="">
                            <input type="file" id="photo" name="photo" class="mt-4 block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer focus:outline-none">
                        </div>
                    </div> --}}

                    {{-- Name --}}
                    <div>
                        <label for="name" class="block text-base font-medium text-gray-500">Nama</label>
                        <p class="text-2xl font-medium">{{ $user->name }}</p>
                    </div>

                    {{-- Username --}}
                    <div>
                        <label for="username" class="block text-base font-medium text-gray-700 mb-2">Username</label>
                        <p class="text-2xl font-medium">{{ $user->username ?? '-' }}</p>
                    </div>
                    
                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-base font-medium text-gray-700 mb-2">Email</label>
                        <p class="text-2xl font-medium">{{ $user->email ?? '-' }}</p>
                    </div>
                    {{-- Alamat --}}
                    <div>
                        <label for="address" class="block text-base font-medium text-gray-700 mb-2">Alamat</label>
                        <p class="text-2xl font-medium">{{ $addresses->get }}</p>
                    </div>

                </div>

                <div class="text-right">
                    <button type="submit"
                        class="px-8 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                        Simpan
                    </button>
                </div>
            </form>
        </div>

        {{-- Back Button --}}
        <div class="text-left mt-8">
            <button onclick="window.history.back()"
                class="px-8 py-3 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
                Kembali
            </button>
        </div>
    </div>
</div>

@endsection