@extends('components.template')
@include('components.sidebarAdmin')
@section('title', 'Kelola Transaksi')
@section('content')
<div class="ml-56 flex-1">
    <!-- Hero Section -->
    <section class="bg-primaryBg p-8 text-center mt-20">
        <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Kelola Transaksi</h1>
        <p class="text-gray-600 mt-2 lg:text-lg">Kelola transaksi yang telah dilakukan oleh pengguna</p>
    </section>

    <!-- Tabel Transaksi -->
    <section class="py-8 mx-4">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="p-4 bg-green-500 text-white font-bold text-lg border-b">
                Daftar Transaksi
            </div>
            <div class="overflow-x-auto">
                <table class="table-auto w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700 text-sm uppercase tracking-wider">
                            <th class="px-4 py-2 border">ID Transaksi</th>
                            <th class="px-4 py-2 border">Nama Pembeli</th>
                            <th class="px-4 py-2 border">Produk</th>
                            <th class="px-4 py-2 border">Total Harga</th>
                            <th class="px-4 py-2 border">Status</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data Transaksi Statis -->
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-gray-800">TRANS001</td>
                            <td class="px-4 py-2 border text-gray-800">John Doe</td>
                            <td class="px-4 py-2 border text-gray-800">Pestisida A</td>
                            <td class="px-4 py-2 border text-gray-800">Rp 150.000</td>
                            <td class="px-4 py-2 border text-gray-800">Selesai</td>
                            <td class="px-4 py-2 border">
                                <a href="/detailtransaksi/1" 
                                   class="bg-green-500 text-white px-4 py-1 rounded text-sm hover:bg-green-600">
                                   Detail
                                </a>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-gray-800">TRANS002</td>
                            <td class="px-4 py-2 border text-gray-800">Jane Smith</td>
                            <td class="px-4 py-2 border text-gray-800">Pestisida B</td>
                            <td class="px-4 py-2 border text-gray-800">Rp 200.000</td>
                            <td class="px-4 py-2 border text-gray-800">Pending</td>
                            <td class="px-4 py-2 border">
                                <a href="/detailtransaksi/2" 
                                   class="bg-green-500 text-white px-4 py-1 rounded text-sm hover:bg-green-600">
                                   Detail
                                </a>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-gray-800">TRANS003</td>
                            <td class="px-4 py-2 border text-gray-800">Alice Brown</td>
                            <td class="px-4 py-2 border text-gray-800">Pestisida C</td>
                            <td class="px-4 py-2 border text-gray-800">Rp 250.000</td>
                            <td class="px-4 py-2 border text-gray-800">Dibatalkan</td>
                            <td class="px-4 py-2 border">
                                <a href="/detailtransaksi/3" 
                                   class="bg-green-500 text-white px-4 py-1 rounded text-sm hover:bg-green-600">
                                   Detail
                                </a>
                            </td>
                        </tr>

                        <!-- Jika tidak ada transaksi -->
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                                Tidak ada transaksi yang tersedia saat ini.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

</div>
@endsection
