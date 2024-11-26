@extends('components.template')
@include('components.sidebarAdmin')
@section('title', 'Kelola Kategori Produk')
@section('content')
<div class="ml-56 flex-1">
    <!-- Hero Section -->
    <section class="bg-primaryBg p-8 text-center mt-20">
        <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Kelola Kategori Produk</h1>
        <p class="text-gray-600 mt-2 lg:text-lg">Kelola kategori produk yang tersedia di platform Anda</p>
    </section>

    <!-- Daftar Kategori Produk -->
    <section class="py-8 mx-4">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="p-4 bg-green-500 text-white font-bold text-lg border-b">
                Daftar Kategori Produk
            </div>
            <div class="overflow-x-auto">
                <table class="table-auto w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700 text-sm uppercase tracking-wider">
                            <th class="px-4 py-2 border">ID Kategori</th>
                            <th class="px-4 py-2 border">Nama Kategori</th>
                            <th class="px-4 py-2 border">Deskripsi</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data Kategori Statis -->
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-gray-800">KAT001</td>
                            <td class="px-4 py-2 border text-gray-800">Pestisida</td>
                            <td class="px-4 py-2 border text-gray-800">Kategori untuk produk pestisida</td>
                            <td class="px-4 py-2 border">
                                <a href="/editkategori/1" 
                                   class="bg-yellow-500 text-white px-4 py-1 rounded text-sm hover:bg-blue-600">
                                   Edit
                                </a>
                                <a href="/hapuskategori/1" 
                                   class="bg-red-500 text-white px-4 py-1 rounded text-sm hover:bg-red-600 ml-2">
                                   Hapus
                                </a>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-gray-800">KAT002</td>
                            <td class="px-4 py-2 border text-gray-800">Alat Pertanian</td>
                            <td class="px-4 py-2 border text-gray-800">Kategori untuk produk alat pertanian</td>
                            <td class="px-4 py-2 border">
                                <a href="/editkategori/2" 
                                   class="bg-yellow-500 text-white px-4 py-1 rounded text-sm hover:bg-blue-600">
                                   Edit
                                </a>
                                <a href="/hapuskategori/2" 
                                   class="bg-red-500 text-white px-4 py-1 rounded text-sm hover:bg-red-600 ml-2">
                                   Hapus
                                </a>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-gray-800">KAT003</td>
                            <td class="px-4 py-2 border text-gray-800">Bibit Tanaman</td>
                            <td class="px-4 py-2 border text-gray-800">Kategori untuk produk bibit tanaman</td>
                            <td class="px-4 py-2 border">
                                <a href="/editkategori/3" 
                                   class="bg-yellow-500 text-white px-4 py-1 rounded text-sm hover:bg-blue-600" onclick="window.location.href='{{route('admin.editkategori')}}'">
                                   Edit
                                </a>
                                <a href="/hapuskategori/3" 
                                   class="bg-red-500 text-white px-4 py-1 rounded text-sm hover:bg-red-600 ml-2" onclick="window.location.href='{{route('admin.editkategori')}}'">
                                   Hapus
                                </a>
                            </td>
                        </tr>

                        <!-- Jika tidak ada kategori -->
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                                Tidak ada kategori yang tersedia saat ini.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Tambah Kategori Button -->
    <section class="py-4 mx-4">
        <div class="flex justify-end">
            <a href="/tambahkategori" 
               class="bg-green-500 text-white px-6 py-2 rounded-md text-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
               Tambah Kategori
            </a>
        </div>
    </section>

</div>
@endsection
