@extends('components.template')
@include('components.sidebarSeller')
@section('title', 'Pesanan Seller')
@section('content')
<div class="ml-56 flex-1">
    <!-- Hero Section -->
    <section class="bg-primaryBg p-8 text-center mt-20">
        <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Pesanan Anda</h1>
        <p class="text-gray-600 mt-2 lg:text-lg">Kelola pesanan dari pelanggan Anda di sini</p>
    </section>

    <!-- Tabel Pesanan -->
    <section class="py-8 mx-4">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="p-4 bg-green-500 text-white font-bold text-lg border-b">
                Daftar Pesanan
            </div>
            <div class="overflow-x-auto">
                <table class="table-auto w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700 text-sm uppercase tracking-wider">
                            <th class="px-4 py-2 border">ID Pesanan</th>
                            <th class="px-4 py-2 border">Nama Pelanggan</th>
                            <th class="px-4 py-2 border">Tanggal</th>
                            <th class="px-4 py-2 border">Total Harga</th>
                            <th class="px-4 py-2 border">Status</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Contoh data pesanan statis -->
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-gray-800">#1234</td>
                            <td class="px-4 py-2 border text-gray-800">John Doe</td>
                            <td class="px-4 py-2 border text-gray-800">25 Nov 2024</td>
                            <td class="px-4 py-2 border text-gray-800">Rp1.000.000</td>
                            <td class="px-4 py-2 border text-gray-800">
                                <span class="inline-block px-3 py-1 text-sm font-semibold bg-yellow-500 text-white">
                                    Pending
                                </span>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex space-x-2">
                                    <a href="#" 
                                       class="bg-blue-500 text-white px-4 py-1 rounded text-sm hover:bg-blue-600">
                                        Detail
                                    </a>
                                    <form action="#" method="POST">
                                        @csrf
                                        <select name="status" class="border rounded px-2 py-1 text-sm" onchange="this.form.submit()">
                                            <option value="Pending" selected>Pending</option>
                                            <option value="Shipped">Shipped</option>
                                            <option value="Completed">Completed</option>
                                        </select>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-gray-800">#1235</td>
                            <td class="px-4 py-2 border text-gray-800">Jane Smith</td>
                            <td class="px-4 py-2 border text-gray-800">26 Nov 2024</td>
                            <td class="px-4 py-2 border text-gray-800">Rp750.000</td>
                            <td class="px-4 py-2 border text-gray-800">
                                <span class="inline-block px-3 py-1 text-sm font-semibold bg-blue-500 text-white">
                                    Shipped
                                </span>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex space-x-2">
                                    <a href="#" 
                                       class="bg-blue-500 text-white px-4 py-1 rounded text-sm hover:bg-blue-600">
                                        Detail
                                    </a>
                                    <form action="#" method="POST">
                                        @csrf
                                        <select name="status" class="border rounded px-2 py-1 text-sm" onchange="this.form.submit()">
                                            <option value="Pending">Pending</option>
                                            <option value="Shipped" selected>Shipped</option>
                                            <option value="Completed">Completed</option>
                                        </select>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-gray-800">#1236</td>
                            <td class="px-4 py-2 border text-gray-800">Alice Johnson</td>
                            <td class="px-4 py-2 border text-gray-800">27 Nov 2024</td>
                            <td class="px-4 py-2 border text-gray-800">Rp500.000</td>
                            <td class="px-4 py-2 border text-gray-800">
                                <span class="inline-block px-3 py-1 text-sm font-semibold bg-green-500 text-white">
                                    Completed
                                </span>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex space-x-2">
                                    <a href="#" 
                                       class="bg-blue-500 text-white px-4 py-1 rounded text-sm hover:bg-blue-600">
                                        Detail
                                    </a>
                                    <form action="#" method="POST">
                                        @csrf
                                        <select name="status" class="border rounded px-2 py-1 text-sm" onchange="this.form.submit()">
                                            <option value="Pending">Pending</option>
                                            <option value="Shipped">Shipped</option>
                                            <option value="Completed" selected>Completed</option>
                                        </select>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Jika tidak ada pesanan -->
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                                Tidak ada pesanan saat ini.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
