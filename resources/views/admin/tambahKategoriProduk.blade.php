@extends('components.template')
@include('components.sidebarAdmin')
@section('title', 'Tambah Kategori Produk')
@section('content')
<div class="ml-56 flex-1">
    <!-- Hero Section -->
    <section class="bg-primaryBg p-8 text-center mt-20">
        <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Tambah Kategori Produk</h1>
        <p class="text-gray-600 mt-2 lg:text-lg">Form untuk menambahkan kategori produk baru</p>
    </section>

    <!-- Form Tambah Kategori Produk -->
    <section class="py-8 mx-4">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="p-4 bg-green-500 text-white font-bold text-lg border-b">
                Tambah Kategori Produk
            </div>
            <form action="{{ route('admin.tambahkategori') }}" method="POST" class="p-6">
                @csrf
                <div class="mb-4">
                    <label for="idKategori" class="block text-gray-700 font-bold mb-2">ID Kategori</label>
                    <input type="text" name="idKategori" id="idKategori" 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" 
                           placeholder="Contoh: KAT004" required>
                </div>
                <div class="mb-4">
                    <label for="namaKategori" class="block text-gray-700 font-bold mb-2">Nama Kategori</label>
                    <input type="text" name="namaKategori" id="namaKategori" 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" 
                           placeholder="Masukkan nama kategori" required>
                </div>
                <div class="mb-4">
                    <label for="deskripsiKategori" class="block text-gray-700 font-bold mb-2">Deskripsi</label>
                    <textarea name="deskripsiKategori" id="deskripsiKategori" rows="4"
                              class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" 
                              placeholder="Masukkan deskripsi kategori" required></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit" 
                            class="bg-green-500 text-white px-6 py-2 rounded-md text-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
