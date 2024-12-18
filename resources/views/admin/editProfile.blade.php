@extends('components.template')
@section('title', 'Edit Profil')
@section('content')

<div class="container mx-auto px-4 py-8 mt-20">
    <div class="max-w-4xl mx-auto space-y-8">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Edit Biodata Diri</h1>
            <p class="text-gray-600">Perbarui informasi diri Anda</p>
        </div>

        <form action="{{ route('admin.profile.update', $admin->user_id) }}" method="POST" class="bg-white shadow-xl rounded-2xl p-8 border border-gray-200">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-base font-medium text-gray-700">Nama</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $admin->name) }}" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                </div>
                <div>
                    <label for="username" class="block text-base font-medium text-gray-700">Username</label>
                    <input type="text" name="username" id="username" value="{{ old('username', $admin->username) }}" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                </div>
                <div class="col-span-1 md:col-span-2">
                    <hr class="border-gray-300">
                </div>
                <div>
                    <label for="email" class="block text-base font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $admin->email) }}" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                </div>
                <div>
                    <label for="password" class="block text-base font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" value="{{ old('password') }} {{ str_repeat('●', min(8, strlen($admin->password))) }}" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                </div>
                <div class="col-span-1 md:col-span-2">
                    <hr class="border-gray-300">
                </div>
                <div class="col-span-1 md:col-span-2 text-right">
                    <button type="submit" class="px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>

        <div class="mt-8">
            <button onclick="window.history.back()" class="px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
                Kembali
            </button>
        </div>
    </div>
</div>

@endsection