@extends('components.template')
@include('components.sidebarAdmin')
@section('title', 'Proses Pesanan')
@section('content')
<div class="ml-56 flex-1">
    <!-- Hero Section -->
    <section class="bg-primaryBg p-8 text-center mt-20">
        <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Proses Pesanan</h1>
        <p class="text-gray-600 mt-2 lg:text-lg">Kelola dan proses pesanan pelanggan secara efisien</p>
    </section>

    <!-- Daftar Pesanan untuk Diproses -->
    <section class="py-8 mx-4">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="p-4 bg-green-500 text-white font-bold text-lg border-b">
                Pesanan yang Perlu Diproses
            </div>
            <div class="overflow-x-auto">
                <table class="table-auto w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700 text-sm uppercase tracking-wider">
                            <th class="px-4 py-2 border">ID Pesanan</th>
                            <th class="px-4 py-2 border">Nama Pembeli</th>
                            <th class="px-4 py-2 border">Tanggal Pesanan</th>
                            <th class="px-4 py-2 border">Alamat</th>
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
                            <td class="px-4 py-2 border text-gray-800">Jl. Anggrek No. 21, Jakarta</td>
                            <td class="px-4 py-2 border text-gray-800">Rp 1,500,000</td>
                            <td class="px-4 py-2 border flex gap-2">
                                <button class="bg-green-500 text-white px-4 py-1 rounded text-sm hover:bg-green-600">
                                    Konfirmasi
                                </button>
                                <button class="bg-red-500 text-white px-4 py-1 rounded text-sm hover:bg-red-600">
                                    Batalkan
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-gray-800">PSN002</td>
                            <td class="px-4 py-2 border text-gray-800">Jane Smith</td>
                            <td class="px-4 py-2 border text-gray-800">2024-11-18</td>
                            <td class="px-4 py-2 border text-gray-800">Jl. Melati No. 15, Bandung</td>
                            <td class="px-4 py-2 border text-gray-800">Rp 800,000</td>
                            <td class="px-4 py-2 border flex gap-2">
                                <button class="bg-green-500 text-white px-4 py-1 rounded text-sm hover:bg-green-600">
                                    Konfirmasi
                                </button>
                                <button class="bg-red-500 text-white px-4 py-1 rounded text-sm hover:bg-red-600">
                                    Batalkan
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-gray-800">PSN003</td>
                            <td class="px-4 py-2 border text-gray-800">Samuel Lee</td>
                            <td class="px-4 py-2 border text-gray-800">2024-11-17</td>
                            <td class="px-4 py-2 border text-gray-800">Jl. Kenanga No. 9, Surabaya</td>
                            <td class="px-4 py-2 border text-gray-800">Rp 500,000</td>
                            <td class="px-4 py-2 border flex gap-2">
                                <button class="bg-green-500 text-white px-4 py-1 rounded text-sm hover:bg-green-600">
                                    Konfirmasi
                                </button>
                                <button class="bg-red-500 text-white px-4 py-1 rounded text-sm hover:bg-red-600">
                                    Batalkan
                                </button>
                            </td>
                        </tr>

                        <!-- Jika Tidak Ada Pesanan -->
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                                Tidak ada pesanan yang perlu diproses saat ini.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
