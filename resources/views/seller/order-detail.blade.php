@include('components.sidebarSeller')
@extends('components.template')
@section('title', 'Detail Pesanan')
@section('content')
<div class="ml-56 flex-1">
    <!-- Hero Section -->
    <section class="bg-primaryBg p-8 text-center mt-20">
        <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Detail Pesanan</h1>
        <p class="text-gray-600 mt-2 lg:text-lg">Lihat detail pesanan dari pelanggan Anda</p>
    </section>
    <section class="py-8 mx-4">
        <div class="grid lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 border-b pb-4">Detail Produk</h2>
                <div class="mt-4 space-y-4">
                    @foreach($order_detail as $detail)
                    <div class="flex justify-between items-center border-b pb-4">
                        <div class="flex items-center space-x-4">
                            <div class="block">
                                <div class="w-20 h-20 flex justify-center items-center">
                                    <img src="{{ asset('storage/' . $detail->product->image_path) }}" alt="" class="object-contain w-28 h-28">  
                                </div>
                            </div>
                            <div class="mt-5">
                                <p class="text-gray-800">{{ $detail->product_name }}</p>
                                <p class="text-lg font-bold text-gray-600">Rp. {{ number_format($detail->price ?? 0, 0, ',', '.') }} </p>
                            </div>
                        </div>
                        <div class="block items-center p-3 mt-10">
                            <p class="text-gray-800 text-lg mt-4 font-medium">Jumlah: {{ $detail->quantity }}</p>
                            <p class="text-gray-800 text-lg mt-4 font-medium">Total: Rp. {{ number_format(($detail->product->price ?? 0) * ($detail->quantity ?? 0), 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 border-b pb-4">Informasi Pengiriman</h2>
                <div class="mt-4">
                    <p class="text-gray-800"><strong>Nama:</strong> {{ $detail->order->user->name ?? 'N/A' }}</p>
                    <p class="text-gray-800 mt-2"><strong>Email:</strong> {{ $detail->order->user->email ?? 'N/A' }}</p>
                </div>
                <h2 class="text-xl font-semibold text-gray-800 border-b pb-4 mt-8">Ringkasan Pesanan</h2>
                <div class="mt-4">
                    <div class="flex justify-between text-gray-800">
                        <p>Total Harga ({{ $detail->quantity ?? 'N/A' }} Barang)</p>
                        <p>Rp. {{ number_format(($detail->product->price ?? 0) * ($detail->quantity ?? 0), 0, ',', '.') }}</p>
                    </div>
                    <div class="flex justify-between text-gray-800 mt-2">
                        <p>Ongkos Kirim</p>
                        <p>Rp20,000</p>
                    </div>
                    <div class="flex justify-between font-bold text-gray-800 mt-4">
                        <p>Total</p>
                        <p>Rp{{ number_format($detail->total ?? 0, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>
@endsection