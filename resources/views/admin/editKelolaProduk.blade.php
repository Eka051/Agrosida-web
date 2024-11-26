@extends('components.template')
@include('components.sidebarAdmin')
@section('title', 'Edit Produk')
@section('content')
<div class="ml-56 flex-1">
    <!-- Hero Section -->
    <section class="bg-primaryBg p-8 text-center mt-20">
        <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Edit Produk</h1>
        <p class="text-gray-600 mt-2 lg:text-lg">Perbarui informasi produk di platform Anda</p>
    </section>

    <!-- Form Edit Produk -->
    <section class="py-8 mx-4">
        <div class="bg-white shadow rounded-lg p-6">
            <form action="#" method="POST" class="space-y-6">
                <!-- ID Produk -->
                <div>
                    <label for="id_produk" class="block text-xl font-medium text-gray-700">ID Produk</label>
                    <input type="text" id="id_produk" name="id_produk" readonly 
                        value="PROD001" 
                        class="mt-1 block w-full rounded-md bg-gray-100 border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                </div>

                <!-- Nama Produk -->
                <div>
                    <label for="nama_produk" class="block text-xl font-medium text-gray-700">Nama Produk</label>
                    <input type="text" id="nama_produk" name="nama_produk" required
                        value="Pestisida A"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                </div>

                <!-- Harga Produk -->
                <div>
                    <label for="harga_produk" class="block text-xl font-medium text-gray-700">Harga Produk</label>
                    <input type="number" id="harga_produk" name="harga_produk" required
                        value="150000"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                </div>

                <!-- Stok Produk -->
                <div>
                    <label for="stok_produk" class="block text-xl font-medium text-gray-700">Stok Produk</label>
                    <input type="number" id="stok_produk" name="stok_produk" required
                        value="50"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                </div>

                <!-- Deskripsi Produk -->
                <div>
                    <label for="deskripsi_produk" class="block text-xl font-medium text-gray-700">Deskripsi Produk</label>
                    <textarea id="deskripsi_produk" name="deskripsi_produk" rows="4" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">Pestisida A adalah pestisida yang efektif untuk mengendalikan hama pada tanaman.</textarea>
                </div>

                <!-- Tombol Simpan -->
                <div class="flex justify-end">
                    <a href="/admin/kelola-produk" 
                        class="bg-gray-500 text-white px-6 py-2 rounded-md text-sm mr-4 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        Batal
                    </a>
                    <button type="submit" 
                        class="bg-green-500 text-white px-6 py-2 rounded-md text-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
