@extends('components.template')
@include('components.sidebarSeller')
@section('title', 'Edit Profil')
@section('content')

<div class="flex flex-col lg:flex-row bg-gray-100 dark:bg-gray-900 min-h-screen">
    <!-- Sidebar -->
    <div class="bg-white dark:bg-gray-800 shadow-md w-full lg:w-1/4 p-6">
        <div class="flex items-center space-x-4">
            <img src="https://via.placeholder.com/100" alt="Profile Picture" class="w-20 h-20 rounded-full object-cover">
            <div>
                <h2 class="text-lg font-bold text-gray-800 dark:text-white">Dian Eka Raharjo</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400">eka@example.com</p>
            </div>
        </div>
        <div class="mt-6">
            <h3 class="text-gray-800 dark:text-white font-bold">Saldo</h3>
            <p class="text-gray-600 dark:text-gray-400">Rp2.161</p>
            <button class="mt-4 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Top-Up</button>
        </div>
    </div>

    <div class="w-full lg:w-3/4 p-6 bg-gray-100 dark:bg-gray-900">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Biodata Diri</h1>
        <form class="space-y-4">
            <div class="flex items-center space-x-6">
                <div>
                    <label for="photo" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Foto Profil</label>
                    <div class="mt-2">
                        <img class="w-24 h-24 rounded-full" src="https://via.placeholder.com/100" alt="">
                    </div>
                    <input type="file" id="photo" class="mt-4 block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer focus:outline-none dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                </div>
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nama</label>
                <input type="text" id="name" value="Dian Eka Raharjo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:border-gray-700 focus:ring-green-500 focus:border-green-500 sm:text-sm">
            </div>

            <div>
                <label for="birthdate" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tanggal Lahir</label>
                <input type="date" id="birthdate" value="2004-10-05" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:border-gray-700 focus:ring-green-500 focus:border-green-500 sm:text-sm">
            </div>

            <div>
                <label for="gender" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Jenis Kelamin</label>
                <select id="gender" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:border-gray-700 focus:ring-green-500 focus:border-green-500 sm:text-sm">
                    <option value="male" selected>Pria</option>
                    <option value="female">Wanita</option>
                </select>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Email</label>
                <input type="email" id="email" value="ekaraharjo7888@gmail.com" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:border-gray-700 focus:ring-green-500 focus:border-green-500 sm:text-sm">
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nomor HP</label>
                <input type="text" id="phone" value="6285156191452" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:border-gray-700 focus:ring-green-500 focus:border-green-500 sm:text-sm">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection
