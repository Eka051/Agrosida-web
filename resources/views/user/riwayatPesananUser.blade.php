@extends('components.template')
@include('components.sidebarUser')
@section('title', 'Riwayat Pesanan')
@section('content')
<div class="ml-56 flex-1">
    <!-- Hero Section -->
    <section class="bg-primaryBg p-8 text-center mt-20">
        <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Riwayat Pesanan Anda</h1>
        <p class="text-gray-600 mt-2 lg:text-lg">Pantau dan cek riwayat pesanan yang telah Anda buat</p>
    </section>

    <!-- Tabel Riwayat Pesanan -->
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
                            <th class="px-4 py-2 border">Tanggal</th>
                            <th class="px-4 py-2 border">Total</th>
                            <th class="px-4 py-2 border">Status</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data Riwayat Pesanan Statis -->
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-gray-800">PES12345</td>
                            <td class="px-4 py-2 border text-gray-800">20 Nov 2024</td>
                            <td class="px-4 py-2 border text-gray-800">Rp 500.000</td>
                            <td class="px-4 py-2 border text-gray-800">
                                <span class="inline-block px-3 py-1 text-sm font-semibold bg-green-500 text-white">
                                    Selesai
                                </span>
                            </td>
                            <td class="px-4 py-2 border">
                                <a href="/pesanan/detail/1" 
                                   class="bg-blue-500 text-white px-4 py-1 rounded text-sm hover:bg-blue-600">
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-gray-800">PES12346</td>
                            <td class="px-4 py-2 border text-gray-800">18 Nov 2024</td>
                            <td class="px-4 py-2 border text-gray-800">Rp 350.000</td>
                            <td class="px-4 py-2 border text-gray-800">
                                <span class="inline-block px-3 py-1 text-sm font-semibold bg-yellow-500 text-white">
                                    Proses
                                </span>
                            </td>
                            <td class="px-4 py-2 border">
                                <a href="/pesanan/detail/2" 
                                   class="bg-blue-500 text-white px-4 py-1 rounded text-sm hover:bg-blue-600">
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-gray-800">PES12347</td>
                            <td class="px-4 py-2 border text-gray-800">15 Nov 2024</td>
                            <td class="px-4 py-2 border text-gray-800">Rp 700.000</td>
                            <td class="px-4 py-2 border text-gray-800">
                                <span class="inline-block px-3 py-1 text-sm font-semibold bg-red-500 text-white">
                                    Dibatalkan
                                </span>
                            </td>
                            <td class="px-4 py-2 border">
                                <a href="/pesanan/detail/3" 
                                   class="bg-blue-500 text-white px-4 py-1 rounded text-sm hover:bg-blue-600">
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>

                        <!-- Jika tidak ada pesanan -->
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                Tidak ada riwayat pesanan saat ini.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
