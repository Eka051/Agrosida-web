@extends('components.template')
@include('components.sidebarSeller')
@section('title', 'Transaksi Seller')
@section('content')
<div class="ml-56 flex-1">
    <!-- Hero Section -->
    <section class="bg-primaryBg p-8 text-center mt-20">
        <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Transaksi Anda</h1>
        <p class="text-gray-600 mt-2 lg:text-lg">Pantau dan kelola transaksi yang dilakukan pelanggan Anda</p>
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
                            <th class="px-4 py-2 border">Nama Pelanggan</th>
                            <th class="px-4 py-2 border">Tanggal</th>
                            <th class="px-4 py-2 border">Total</th>
                            <th class="px-4 py-2 border">Metode Pembayaran</th>
                            <th class="px-4 py-2 border">Status</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data Transaksi Statis -->
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-gray-800">TXN12345</td>
                            <td class="px-4 py-2 border text-gray-800">John Doe</td>
                            <td class="px-4 py-2 border text-gray-800">25 Nov 2024</td>
                            <td class="px-4 py-2 border text-gray-800">Rp1.200.000</td>
                            <td class="px-4 py-2 border text-gray-800">Credit Card</td>
                            <td class="px-4 py-2 border">
                                <span class="inline-block px-3 py-1 text-sm font-semibold bg-green-500 text-white rounded-md">
                                    Completed
                                </span>
                            </td>
                            <td class="px-4 py-2 border">
                                <a href="/transactions/TXN12345" class="bg-blue-500 text-white px-4 py-1 rounded-md text-sm hover:bg-blue-600">
                                    Detail
                                </a>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-gray-800">TXN12346</td>
                            <td class="px-4 py-2 border text-gray-800">Jane Smith</td>
                            <td class="px-4 py-2 border text-gray-800">26 Nov 2024</td>
                            <td class="px-4 py-2 border text-gray-800">Rp500.000</td>
                            <td class="px-4 py-2 border text-gray-800">Bank Transfer</td>
                            <td class="px-4 py-2 border">
                                <span class="inline-block px-3 py-1 text-sm font-semibold bg-yellow-500 text-white rounded-md">
                                    Pending
                                </span>
                            </td>
                            <td class="px-4 py-2 border">
                                <a href="/transactions/TXN12346" class="bg-blue-500 text-white px-4 py-1 rounded-md text-sm hover:bg-blue-600">
                                    Detail
                                </a>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-gray-800">TXN12347</td>
                            <td class="px-4 py-2 border text-gray-800">David Johnson</td>
                            <td class="px-4 py-2 border text-gray-800">26 Nov 2024</td>
                            <td class="px-4 py-2 border text-gray-800">Rp300.000</td>
                            <td class="px-4 py-2 border text-gray-800">PayPal</td>
                            <td class="px-4 py-2 border">
                                <span class="inline-block px-3 py-1 text-sm font-semibold bg-red-500 text-white rounded-md">
                                    Canceled
                                </span>
                            </td>
                            <td class="px-4 py-2 border">
                                <a href="/transactions/TXN12347" class="bg-blue-500 text-white px-4 py-1 rounded-md text-sm hover:bg-blue-600">
                                    Detail
                                </a>
                            </td>
                        </tr>

                        <!-- Jika tidak ada transaksi -->
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                                Tidak ada transaksi saat ini.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
