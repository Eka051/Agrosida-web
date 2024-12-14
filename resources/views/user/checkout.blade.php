@extends('components.template')
@include('components.sidebarUser')
@section('title', 'Checkout Produk')
@section('content')
<div class="ml-56 flex-1">
    <!-- Hero Section -->
    <section class="bg-primaryBg p-8 text-center mt-20">
        <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Checkout Produk</h1>
        <p class="text-gray-600 mt-2 lg:text-lg">Konfirmasi pesanan Anda dan isi detail pengiriman</p>
    </section>

    <!-- Detail Pesanan -->
    <section class="py-8 mx-4">
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Kolom Kiri: Detail Produk -->
            <div class="lg:col-span-2 bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 border-b pb-4">Detail Produk</h2>
                <div class="mt-4 space-y-4">
                    <div class="flex justify-between items-center border-b pb-4">
                        <div class="flex items-center space-x-4">
                            <div class="bg-gray-200 h-16 w-16 rounded"></div>
                            <div>
                                <p class="text-gray-800 font-medium">Pestisida A</p>
                                <p class="text-sm text-gray-600">Rp25.000 x 1</p>
                            </div>
                        </div>
                        <p class="text-gray-800 font-medium">Rp25.000</p>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Ringkasan dan Form Pengiriman -->
            <div class="bg-white shadow rounded-lg p-6">
                <!-- Ringkasan Pesanan -->
                <h2 class="text-xl font-semibold text-gray-800 border-b pb-4">Ringkasan Pesanan</h2>
                <div class="mt-4">
                    <div class="flex justify-between text-gray-800">
                        <p>Total Harga (1 Barang)</p>
                        <p>Rp25.000</p>
                    </div>
                </div>

                <!-- Informasi Pengiriman -->
                <h2 class="text-xl font-semibold text-gray-800 border-b pb-4 mt-8">Informasi Pengiriman</h2>
                <div class="mt-4 space-y-4">
                    <div>
                        <p class="text-gray-600">Nama Penerima</p>
                        <p class="text-gray-800 font-medium">Linatul Habibah</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Alamat Pengiriman</p>
                        <p class="text-gray-800 font-medium">Jalan Jawa 7 No 123, Sumbersari, Kab. Jember, Jawa Timur</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Nomor Telepon</p>
                        <p class="text-gray-800 font-medium">6285281612326</p>
                    </div>
                </div>
                <button class="w-full bg-green-500 text-white font-medium py-3 rounded-lg hover:bg-green-600 mt-6">
                    Pilih Pembayaran
                </button>
            </div>
        </div>
    </section>
</div>
@endsection
