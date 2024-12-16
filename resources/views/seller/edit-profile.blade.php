@extends('components.template')
@section('title', 'Edit Profile')
@section('content')

<div class="container mx-auto px-4 py-8 mt-20">
    <div class="max-w-4xl mx-auto space-y-8">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Edit Profil Toko</h1>
            <p class="text-gray-600">Perbarui informasi toko Anda</p>
        </div>

        <form action="{{ route('seller.profile.update') }}" method="POST" class="bg-white shadow-xl rounded-2xl p-8 border border-gray-200">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="store_name" class="block text-base font-medium text-gray-700">Nama Toko</label>
                    <input type="text" id="store_name" name="store_name" value="{{ $user->store->name }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-300">
                </div>
                <div>
                    <label for="name" class="block text-base font-medium text-gray-700">Nama Penjual</label>
                    <input type="text" id="name" name="name" value="{{ $user->name }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-300">
                </div>
                <div>
                    <label for="email" class="block text-base font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" value="{{ $user->email }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-300">
                </div>
                <div>
                    <label for="username" class="block text-base font-medium text-gray-700">Username</label>
                    <input type="text" id="username" name="username" value="{{ $user->username }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-300">
                </div>
                <div>
                    <label for="password" class="block text-base font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-300"
                        placeholder="Masukkan password baru">
                </div>
                <div class="col-span-1 md:col-span-2">
                    <label for="address" class="block text-base font-medium text-gray-700">Alamat</label>
                    <textarea id="address" name="address" rows="3"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-300"
                        placeholder="Masukkan alamat lengkap">{{ $user->address->detail_address ?? '' }}</textarea>
                </div>
            </div>

            <div class="text-right mt-4">
                <button type="submit"
                    class="px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                    Simpan Perubahan
                </button>
            </div>
        </form>
        <div class="text-left mt-8">
            <button
                class="px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
                <a href="{{ route('seller.dashboard') }}">Kembali</a>
            </button>
        </div>
    </div>
</div>
@endsection