@extends('components.template')
@include('components.sidebarAdmin')
@section('title', 'Kelola Produk')
@section('content')
<div class="ml-56 flex-1">
    <!-- Hero Section -->
    <section class="bg-primaryBg p-8 text-center mt-20">
        <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Kelola Produk</h1>
        <p class="text-gray-600 mt-2 lg:text-lg">Kelola produk yang tersedia di marketplace</p>
    </section>

    <!-- Tabel Produk -->
    <section class="py-8 mx-4">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="p-4 bg-green-500 text-white font-bold text-lg border-b">
                Daftar Produk
            </div>
            <div class="overflow-x-auto">
                <table class="table-auto w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700 text-sm uppercase tracking-wider">
                            <th class="px-4 py-2 border">ID Produk</th>
                            <th class="px-4 py-2 border">Nama Produk</th>
                            <th class="px-4 py-2 border">Harga</th>
                            <th class="px-4 py-2 border">Stok</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data Produk Statis -->
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-gray-800">PROD001</td>
                            <td class="px-4 py-2 border text-gray-800">Pestisida A</td>
                            <td class="px-4 py-2 border text-gray-800">Rp 150.000</td>
                            <td class="px-4 py-2 border text-gray-800">50</td>
                            <td class="px-4 py-2 border">
                                <a href="{{route('admin.editproduk')}}" class="bg-yellow-500 text-white px-4 py-1 rounded text-sm hover:bg-yellow-600">
                                   Edit
                                </a>
                                <a href="/hapusproduk/1" 
                                   class="bg-red-500 text-white px-4 py-1 rounded text-sm hover:bg-red-600" onclick="window.location.href='{{route('admin.editproduk')}}'">
                                   Hapus
                                </a>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-gray-800">PROD002</td>
                            <td class="px-4 py-2 border text-gray-800">Pestisida B</td>
                            <td class="px-4 py-2 border text-gray-800">Rp 200.000</td>
                            <td class="px-4 py-2 border text-gray-800">30</td>
                            <td class="px-4 py-2 border">
                                <a href="{{route('admin.editproduk')}}" class="bg-yellow-500 text-white px-4 py-1 rounded text-sm hover:bg-yellow-600">
                                   Edit
                                </a>
                                <a href="/hapusproduk/2" 
                                   class="bg-red-500 text-white px-4 py-1 rounded text-sm hover:bg-red-600">
                                   Hapus
                                </a>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-gray-800">PROD003</td>
                            <td class="px-4 py-2 border text-gray-800">Pestisida C</td>
                            <td class="px-4 py-2 border text-gray-800">Rp 250.000</td>
                            <td class="px-4 py-2 border text-gray-800">20</td>
                            <td class="px-4 py-2 border">
                                <a href="{{route('admin.editproduk')}}" class="bg-yellow-500 text-white px-4 py-1 rounded text-sm hover:bg-yellow-600">
                                   Edit
                                </a>
                                <a href="/hapusproduk/3" 
                                   class="bg-red-500 text-white px-4 py-1 rounded text-sm hover:bg-red-600">
                                   Hapus
                                </a>
                            </td>
                        </tr>

                        <!-- Jika tidak ada produk -->
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                Tidak ada produk yang tersedia saat ini.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Tombol Tambah Produk -->
    <section class="py-8 mx-4">
        <div class="flex justify-end">
            <a href="{{route('admin.tambahproduk')}}" class="bg-green-500 text-white px-6 py-2 rounded-md text-sm hover:bg-green-600">
                Tambah Produk
            </a>
        </div>
    </section>
</div>
@endsection
