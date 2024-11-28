@extends('components.template')
@include('components.sidebarSeller')
@section('title', 'Tambah Produk')
@section('content')
<div class="ml-56 flex-1">
    <!-- Hero Section -->
    <section class="bg-primaryBg p-8 text-center mt-20">
        <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Tambah Produk</h1>
        <p class="text-gray-600 mt-2 lg:text-lg">Tambah produk baru untuk toko Anda</p>
    </section>

    <!-- Form Tambah Produk -->
    <section class="py-8 mx-4">
        <div class="bg-white shadow rounded-lg p-6">
            <form action="" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Nama Produk -->
                <div>
                    <label for="product_name" class="block text-xl font-medium text-gray-700">Nama Produk</label>
                    <input type="text" name="product_name" id="product_name" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" value="Produk A">
                </div>

                <!-- Harga Produk -->
                <div>
                    <label for="price" class="block text-xl font-medium text-gray-700">Harga (Rp)</label>
                    <input type="number" name="price" id="price" required min="0" step="1000"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" value="50000">
                </div>

                <!-- Deskripsi Produk -->
                <div>
                    <label for="description" class="block text-xl font-medium text-gray-700">Deskripsi</label>
                    <textarea name="description" id="description" rows="4" required
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">Deskripsi produk A</textarea>
                </div>

                <!-- Gambar Produk -->
                <div>
                    <label for="image" class="block text-xl font-medium text-gray-700">Gambar Produk</label>
                    <input type="file" name="image" id="image" accept="image/*"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                </div>

                <!-- Tombol Simpan -->
                <div class="flex justify-end">
                    <button type="submit"
                            class="bg-green-500 text-white px-6 py-2 rounded-md text-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                        Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection