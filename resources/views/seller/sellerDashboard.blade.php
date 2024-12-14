@extends('components.template')
@include('components.sidebarSeller')
@section('title', 'Seller Dashboard')
@section('content')

<div class="ml-48 flex-1">
    <!-- Hero Section for Seller Dashboard -->
    <section class="bg-green-100 p-8 text-center mt-20">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard Penjual</h1>
        <p class="text-gray-600">Kelola produk Anda dengan mudah</p>
        <div class="mt-4 flex justify-center">
            <input type="text" placeholder="Cari produk Anda"
                class="p-2 rounded-l border border-gray-300 w-1/2 md:w-1/3">
            <button class="bg-green-500 text-white px-4 py-2 rounded-r">Search</button>
        </div>
    </section>

    <!-- Produk Section -->
    <section class="py-8">
        <div class="flex justify-between items-center mx-4">
            <h2 class="text-2xl font-semibold text-gray-800">Produk Anda</h2>
            <button class="bg-green-500 text-white px-4 py-2 rounded" onclick="window.location.href='{{route('seller.tambahproduk')}}'">Tambah Produk</button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-6 mt-6 mx-4">
            <!-- Product Cards -->
            @foreach (range(1, 8) as $product)
                <div class="border rounded-lg p-4 text-center bg-white shadow">
                    <div class="bg-gray-200 h-32 w-32 mx-auto"></div>
                    <h3 class="mt-4 font-medium text-gray-800">Product Name</h3>
                    <p class="text-blue-600">$20.00</p>
                    <div class="flex justify-center mt-4 space-x-2">
                        <button class="bg-yellow-500 text-white px-4 py-1 rounded" onclick="window.location.href='{{route('seller.editproduk')}}'">Edit</button>
                        <button class="bg-red-500 text-white px-4 py-1 rounded">Delete</button>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>

@endsection
