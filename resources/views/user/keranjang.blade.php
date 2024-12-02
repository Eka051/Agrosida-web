@extends('components.template')
@include('components.sidebarUser')
@section('title', 'Keranjang Belanja')
@section('content')
<div class="ml-56 flex-1">
    <!-- Hero Section -->
    <section class="bg-primaryBg p-8 text-center mt-20">
        <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Keranjang Belanja</h1>
        <p class="text-gray-600 mt-2 lg:text-lg">Kelola produk yang ingin Anda beli</p>
    </section>

    <!-- Daftar Produk di Keranjang -->
    <section class="py-8">
        <div class="mx-4 bg-white shadow rounded-lg overflow-hidden">
            <div class="p-4 bg-green-500 text-white font-bold text-lg border-b">
                Produk dalam Keranjang
            </div>
            <div class="overflow-x-auto">
                <table class="table-auto w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700 text-sm uppercase tracking-wider">
                            <th class="px-4 py-2 border">Produk</th>
                            <th class="px-4 py-2 border">Harga Satuan</th>
                            <th class="px-4 py-2 border">Kuantitas</th>
                            <th class="px-4 py-2 border">Subtotal</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data Statis -->
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-gray-800 flex items-center space-x-4">
                                <div class="bg-gray-200 h-16 w-16 rounded"></div>
                                <span>Pestisida A</span>
                            </td>
                            <td class="px-4 py-2 border text-gray-800">Rp100,000</td>
                            <td class="px-4 py-2 border text-gray-800">
                                <input type="number" value="2" min="1" class="w-16 border rounded text-center" readonly>
                            </td>
                            <td class="px-4 py-2 border text-gray-800">Rp200,000</td>
                            <td class="px-4 py-2 border">
                                <button class="bg-red-500 text-white px-4 py-1 rounded text-sm hover:bg-red-600">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-gray-800 flex items-center space-x-4">
                                <div class="bg-gray-200 h-16 w-16 rounded"></div>
                                <span>Pestisida B</span>
                            </td>
                            <td class="px-4 py-2 border text-gray-800">Rp150,000</td>
                            <td class="px-4 py-2 border text-gray-800">
                                <input type="number" value="1" min="1" class="w-16 border rounded text-center" readonly>
                            </td>
                            <td class="px-4 py-2 border text-gray-800">Rp150,000</td>
                            <td class="px-4 py-2 border">
                                <button class="bg-red-500 text-white px-4 py-1 rounded text-sm hover:bg-red-600">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Total Harga dan Checkout -->
        <div class="flex justify-between items-center mx-4 mt-6">
            <div class="text-lg font-semibold text-gray-800">
                Total: Rp350,000
            </div>
            <a href="{{route('user.checkout')}}" class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600">
                Lanjut ke Checkout
            </a>
        </div>
    </section>
</div>
@endsection
