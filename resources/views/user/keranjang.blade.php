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
    <section class="py-8 flex flex-col lg:flex-row justify-between">
        <!-- Daftar Produk -->
        <div class="mx-4 bg-white shadow rounded-lg overflow-hidden w-full lg:w-3/4">
            <div class="p-4 bg-green-500 text-white font-bold text-lg border-b">
                Produk dalam Keranjang
            </div>
            <div class="overflow-x-auto">
                <table class="table-auto w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700 text-sm uppercase tracking-wider">
                            <th class="px-4 py-2 border"><input type="checkbox" class="form-checkbox"></th>
                            <th class="px-4 py-2 border">Produk</th>
                            <th class="px-4 py-2 border">Harga Satuan</th>
                            <th class="px-4 py-2 border">Kuantitas</th>
                            <th class="px-4 py-2 border">Subtotal</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data Produk -->
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-center">
                                <input type="checkbox" class="form-checkbox">
                            </td>
                            <td class="px-4 py-2 border text-gray-800 flex items-center space-x-4">
                                <div class="h-16 w-16 bg-gray-200 rounded"></div>
                                <span>Pestisida A</span>
                            </td>
                            <td class="px-4 py-2 border text-gray-800">Rp126,000</td>
                            <td class="px-4 py-2 border text-gray-800">
                                <div class="flex items-center space-x-2">
                                    <button class="px-2 py-1 bg-gray-300 rounded">-</button>
                                    <span>1</span>
                                    <button class="px-2 py-1 bg-gray-300 rounded">+</button>
                                </div>
                            </td>
                            <td class="px-4 py-2 border text-gray-800">Rp126,000</td>
                            <td class="px-4 py-2 border">
                                <button class="bg-red-500 text-white px-4 py-1 rounded text-sm hover:bg-red-600">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-center">
                                <input type="checkbox" class="form-checkbox">
                            </td>
                            <td class="px-4 py-2 border text-gray-800 flex items-center space-x-4">
                                <div class="h-16 w-16 bg-gray-200 rounded"></div>
                                <span>Pestisida B</span>
                            </td>
                            <td class="px-4 py-2 border text-gray-800">Rp51,888</td>
                            <td class="px-4 py-2 border text-gray-800">
                                <div class="flex items-center space-x-2">
                                    <button class="px-2 py-1 bg-gray-300 rounded">-</button>
                                    <span>1</span>
                                    <button class="px-2 py-1 bg-gray-300 rounded">+</button>
                                </div>
                            </td>
                            <td class="px-4 py-2 border text-gray-800">Rp51,888</td>
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

        <!-- Total dan Promo -->
        <div class="mx-4 mt-6 lg:mt-0 bg-white shadow rounded-lg overflow-hidden w-full lg:w-1/4">
            <div class="p-4 bg-green-500 text-white font-bold text-lg border-b">
                Ringkasan Belanja
            </div>
            <div class="p-4">
                <div class="flex justify-between text-gray-800 mb-4">
                    <span>Total:</span>
                    <span class="font-bold">Rp177,888</span>
                </div>
                <a href="{{route('user.checkout')}}" class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600">
                    Lanjut ke Checkout
                </a>
            </div>
        </div>
    </section>
</div>
@endsection
