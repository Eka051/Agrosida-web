@extends('components.template')
@include('components.sidebarAdmin')
@section('title', 'Admin Dashboard')
@section('content')

<!-- Main Content -->
<main class="mt-20 ml-56 flex-1">
    <!-- Search Bar -->
    <div class="mb-6">
        <input type="text" placeholder="Cari produk" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
    </div>

    <!-- Dashboard Stats -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <div class="bg-white p-4 shadow rounded-lg text-center">
            <h3 class="text-lg font-semibold">Total Produk</h3>
            <p class="text-2xl font-bold">120 Produk</p>
        </div>
        <div class="bg-white p-4 shadow rounded-lg text-center">
            <h3 class="text-lg font-semibold">Total Transaksi</h3>
            <p class="text-2xl font-bold">245 Transaksi</p>
        </div>
        <div class="bg-white p-4 shadow rounded-lg text-center">
            <h3 class="text-lg font-semibold">Total Pendapatan</h3>
            <p class="text-2xl font-bold">Rp 15.500.000</p>
        </div>
    </div>

    <!-- Product List -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-4 shadow rounded-lg text-center">
            <img src="https://via.placeholder.com/100" alt="Pestisida Organik" class="mx-auto mb-4">
            <h4 class="font-semibold">Pestisida Organik</h4>
            <p class="text-green-500 font-bold">Rp 80.000</p>
        </div>
        <div class="bg-white p-4 shadow rounded-lg text-center">
            <img src="https://via.placeholder.com/100" alt="Insektisida Alami" class="mx-auto mb-4">
            <h4 class="font-semibold">Insektisida Alami</h4>
            <p class="text-green-500 font-bold">Rp 90.000</p>
        </div>
        <div class="bg-white p-4 shadow rounded-lg text-center">
            <img src="https://via.placeholder.com/100" alt="Herbisida" class="mx-auto mb-4">
            <h4 class="font-semibold">Herbisida</h4>
            <p class="text-green-500 font-bold">Rp 70.000</p>
        </div>
        <div class="bg-white p-4 shadow rounded-lg text-center">
            <img src="https://via.placeholder.com/100" alt="Fungisida" class="mx-auto mb-4">
            <h4 class="font-semibold">Fungisida</h4>
            <p class="text-green-500 font-bold">Rp 75.000</p>
        </div>
        <!-- Tambahkan lebih banyak produk sesuai kebutuhan -->
    </div>
</main>

@endsection
