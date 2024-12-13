@extends('components.template')
@include('components.sidebarAdmin')
@section('title', 'Semua Pesanan')
@section('content')
<div class="ml-56 flex-1">
    <!-- Hero Section -->
    <section class="bg-primaryBg p-8 text-center mt-20">
        <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Semua Pesanan</h1>
        <p class="text-gray-600 mt-2 lg:text-lg">Lihat dan kelola seluruh pesanan yang telah dibuat oleh pelanggan</p>
    </section>

    <!-- Tabel Semua Pesanan -->
    <section class="py-8 mx-4">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="p-4 bg-green-500 text-white font-bold text-lg border-b">
                Daftar Semua Pesanan
            </div>
            <div class="overflow-x-auto">
                <table class="table-auto w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700 text-sm uppercase tracking-wider">
                            <th class="px-4 py-2 border">ID Pesanan</th>
                            <th class="px-4 py-2 border">Nama Pembeli</th>
                            <th class="px-4 py-2 border">Tanggal Pesanan</th>
                            <th class="px-4 py-2 border">Status</th>
                            <th class="px-4 py-2 border">Total Harga</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data Pesanan Statis -->
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-gray-800">PSN001</td>
                            <td class="px-4 py-2 border text-gray-800">John Doe</td>
                            <td class="px-4 py-2 border text-gray-800">2024-11-20</td>
                            <td class="px-4 py-2 border text-gray-800">
                                <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded">Selesai</span>
                            </td>
                            <td class="px-4 py-2 border text-gray-800">Rp 1,500,000</td>
                            <td class="px-4 py-2 border">
                                <button class="bg-green-500 text-white px-4 py-1 rounded text-sm hover:bg-green-600" onclick="window.location.href='{{route('admin.prosespesanan')}}'">
                                    Proses
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-gray-800">PSN002</td>
                            <td class="px-4 py-2 border text-gray-800">Jane Smith</td>
                            <td class="px-4 py-2 border text-gray-800">2024-11-18</td>
                            <td class="px-4 py-2 border text-gray-800">
                                <span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded">Diproses</span>
                            </td>
                            <td class="px-4 py-2 border text-gray-800">Rp 800,000</td>
                            <td class="px-4 py-2 border">
                                <button class="bg-green-500 text-white px-4 py-1 rounded text-sm hover:bg-green-600" onclick="window.location.href='{{route('admin.prosespesanan')}}'">
                                    Proses
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-gray-800">PSN003</td>
                            <td class="px-4 py-2 border text-gray-800">Samuel Lee</td>
                            <td class="px-4 py-2 border text-gray-800">2024-11-17</td>
                            <td class="px-4 py-2 border text-gray-800">
                                <span class="bg-red-100 text-red-700 text-xs px-2 py-1 rounded">Dibatalkan</span>
                            </td>
                            <td class="px-4 py-2 border text-gray-800">Rp 500,000</td>
                            <td class="px-4 py-2 border">
                                <button class="bg-green-500 text-white px-4 py-1 rounded text-sm hover:bg-green-600" onclick="window.location.href='{{route('admin.prosespesanan')}}'">
                                    Proses
                                </button>
                            </td>
                        </tr>

                        <!-- Jika Tidak Ada Pesanan -->
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