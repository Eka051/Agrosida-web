@extends('components.template')
@include('components.sidebarAdmin')
@section('title', 'Edit Kategori Produk')
@section('content')
<div class="ml-56 flex-1">
    <!-- Hero Section -->
    <section class="bg-primaryBg p-8 text-center mt-20">
        <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Edit Kategori Produk</h1>
        <p class="text-gray-600 mt-2 lg:text-lg">Perbarui informasi kategori produk</p>
    </section>

    <!-- Form Edit Kategori -->
    <section class="py-8 mx-4">
        <div class="bg-white shadow rounded-lg p-6">
            <form action="#" method="POST" class="space-y-6">
                <!-- ID Kategori -->
                <div>
                    <label for="id_kategori" class="block text-xl font-medium text-gray-700">ID Kategori</label>
                    <input type="text" id="id_kategori" name="id_kategori" readonly 
                        value="KAT001" 
                        class="mt-1 block w-full rounded-md bg-gray-100 border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                </div>

                <!-- Nama Kategori -->
                <div>
                    <label for="nama_kategori" class="block text-xl font-medium text-gray-700">Nama Kategori</label>
                    <input type="text" id="nama_kategori" name="nama_kategori" required
                        value="Pestisida"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                </div>

                <!-- Deskripsi Kategori -->
                <div>
                    <label for="deskripsi_kategori" class="block text-xl font-medium text-gray-700">Deskripsi</label>
                    <textarea id="deskripsi_kategori" name="deskripsi_kategori" rows="4" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">Kategori untuk produk pestisida</textarea>
                </div>

                <!-- Tombol Simpan -->
                <div class="flex justify-end">
                    <a href="/admin/kategori" 
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
