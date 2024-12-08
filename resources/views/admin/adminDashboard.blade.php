@extends('components.template')
@include('components.sidebarAdmin')
@section('title', 'Admin Dashboard')
@section('content')

<main class="mt-24 ml-56 flex-1 bg-gray-100 min-h-screen">
    <!-- Header -->
    <div class="bg-greenPrimary text-white py-6 px-8 rounded-lg shadow-md mb-8">
        <h1 class="text-4xl font-bold">Dashboard Admin</h1>
        <p class="text-lg">Selamat datang, kelola marketplace Anda dengan mudah.</p>
    </div>

    <!-- Cards Summary -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <div class="bg-white p-6 shadow-md border border-gray-200 rounded-lg text-center hover:shadow-lg transition">
            <div class="flex items-center justify-center mb-4">
                <i class="fas fa-box-open text-5xl text-blue-500"></i>
            </div>
            <h3 class="text-xl font-semibold">Total Produk</h3>
            <span class="iconify" data-icon="fluent-mdl2:product-variant" data-inline="false" style="width: 36px; height: 36px; color: #000;"></span>
            <p class="text-3xl font-bold text-blue-600">{{ $totalProduct }} Produk</p>
        </div>
        <div class="bg-white p-6 shadow-md border border-gray-200 rounded-lg text-center hover:shadow-lg transition">
            <div class="flex items-center justify-center mb-4">
                <i class="fas fa-exchange-alt text-5xl text-green-500"></i>
            </div>
            <h3 class="text-xl font-semibold">Total Transaksi</h3>
            <span class="iconify" data-icon="fluent:product-catalogue" data-inline="false" style="width: 36px; height: 36px; color: #000;"></span>
            <p class="text-3xl font-bold text-green-600">{{ $totalOrder }} Transaksi</p>
        </div>
        <div class="bg-white p-6 shadow-md border border-gray-200 rounded-lg text-center hover:shadow-lg transition">
            <div class="flex items-center justify-center mb-4">
                <i class="fas fa-wallet text-5xl text-yellow-500"></i>
            </div>
            <h3 class="text-xl font-semibold">Total Pendapatan</h3>
            <p class="text-3xl font-bold text-yellow-600">Rp {{ number_format($balance, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Recent Orders & Top Products -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Recent Orders -->
        <div class="bg-white p-6 shadow-md border border-gray-200 rounded-lg hover:shadow-lg transition">
            <h3 class="text-lg font-semibold mb-4 text-gray-700">Recent Orders</h3>
            <ul>
                {{-- @foreach($recentOrders as $order)
                    <li class="flex justify-between mb-2">
                        <span>Order #{{ $order->id }}</span>
                        <span class="text-{{ $order->status_color }} font-medium">{{ $order->status }}</span>
                    </li>
                @endforeach --}}
            </ul>
        </div>
        <!-- Top Products -->
        <div class="bg-white p-6 shadow-md border border-gray-200 rounded-lg hover:shadow-lg transition">
            <h3 class="text-lg font-semibold mb-4 text-gray-700">Top Products</h3>
            <ul>
                {{-- @foreach($topProducts as $product)
                    <li class="flex justify-between mb-2">
                        <span>{{ $product->name }}</span>
                        <span class="text-blue-500 font-medium">{{ $product->sales }} Sales</span>
                    </li>
                @endforeach --}}
            </ul>
        </div>
    </div>
</main>

@endsection
