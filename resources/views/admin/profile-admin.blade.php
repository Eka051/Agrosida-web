@extends('components.template')
@section('title', 'Profil')
@section('content')

<div class="container mx-auto px-4 py-8 mt-20">
    <div class="max-w-4xl mx-auto space-y-8">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Biodata Diri</h1>
            <p class="text-gray-600">Lihat informasi diri Anda</p>
        </div>

        <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-base font-medium text-gray-700">Nama</label>
                    <p class="text-xl font-medium text-gray-900">{{ $admin->name ?? '-' }}</p>
                </div>
                <div>
                    <label for="username" class="block text-base font-medium text-gray-700">Username</label>
                    <p class="text-xl font-medium text-gray-900">{{ $admin->username ?? '-' }}</p>
                </div>
                <div class="col-span-1 md:col-span-2">
                    <hr class="border-gray-300">
                </div>
                <div>
                    <label for="email" class="block text-base font-medium text-gray-700">Email</label>
                    <p class="text-xl font-medium text-gray-900">{{ $admin->email ?? '-' }}</p>
                </div>
                <div>
                    <label for="password" class="block text-base font-medium text-gray-700">Password</label>
                    <p class="text-base text-gray-900">{{ str_repeat('●', min(8, strlen(old('password', $admin->password)))) }}</p>
                </div>
                <div class="col-span-1 md:col-span-2">
                    <hr class="border-gray-300">
                </div>
                <button class="col-span-1 md:col-span-2 text-right">
                    <a href="{{ route('admin.profile.edit', $admin->user_id) }}"
                        class="px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                        Edit Profil
                    </a>
                </button>
            </div>
        </div>

        <div class="text-left mt-8">
            <button onclick="window.history.back()"
                class="px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
                Kembali
            </button>
        </div>
    </div>
</div>

@endsection