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
                    <!-- Produk Statis -->
                    <div class="flex justify-between items-center border-b pb-4">
                        <div class="flex items-center space-x-4">
                            <div class="bg-gray-200 h-16 w-16 rounded"></div>
                            <div>
                                <p class="text-gray-800 font-medium">Pestisida A</p>
                                <p class="text-sm text-gray-600">Rp100,000 x 2</p>
                            </div>
                        </div>
                        <p class="text-gray-800 font-medium">Rp200,000</p>
                    </div>
                    <div class="flex justify-between items-center border-b pb-4">
                        <div class="flex items-center space-x-4">
                            <div class="bg-gray-200 h-16 w-16 rounded"></div>
                            <div>
                                <p class="text-gray-800 font-medium">Pestisida B</p>
                                <p class="text-sm text-gray-600">Rp150,000 x 1</p>
                            </div>
                        </div>
                        <p class="text-gray-800 font-medium">Rp150,000</p>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Ringkasan dan Form Pengiriman -->
            <div class="bg-white shadow rounded-lg p-6">
                <!-- Ringkasan Pesanan -->
                <h2 class="text-xl font-semibold text-gray-800 border-b pb-4">Ringkasan Pesanan</h2>
                <div class="mt-4">
                    <div class="flex justify-between text-gray-800">
                        <p>Subtotal</p>
                        <p>Rp350,000</p>
                    </div>
                    <div class="flex justify-between text-gray-800 mt-2">
                        <p>Ongkos Kirim</p>
                        <p>Rp20,000</p> <!-- Ongkir tetap -->
                    </div>
                    <div class="flex justify-between font-bold text-gray-800 mt-4">
                        <p>Total</p>
                        <p>Rp370,000</p>
                    </div>
                </div>

                <!-- Form Pengiriman -->
                <h2 class="text-xl font-semibold text-gray-800 border-b pb-4 mt-8">Informasi Pengiriman</h2>
                <form action="/checkout" method="POST" class="mt-4 space-y-4">
                    <!-- Form Statis -->
                    <div>
                        <label for="name" class="block text-gray-600">Nama Penerima</label>
                        <input type="text" id="name" name="name" value="John Doe" readonly class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 bg-gray-100">
                    </div>
                    <div>
                        <label for="address" class="block text-gray-600">Alamat Pengiriman</label>
                        <textarea id="address" name="address" readonly rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 bg-gray-100">Jl. Mawar No.123, Jakarta</textarea>
                    </div>
                    <div>
                        <label for="phone" class="block text-gray-600">Nomor Telepon</label>
                        <input type="text" id="phone" name="phone" value="081234567890" readonly class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 bg-gray-100">
                    </div>
                    <button type="button" class="w-full bg-green-500 text-white font-medium py-3 rounded-lg hover:bg-green-600">
                        Proses Pesanan
                    </button>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
