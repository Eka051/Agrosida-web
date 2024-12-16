@extends('components.template')
@include('components.sidebarUser')
@section('title', 'Detail Pesanan')
@section('content')
<div class="ml-64 flex-1 mt-20">
    <div class="container ml-6 mt-4">
        <nav class="text-lg">
            <ol class="list-reset flex text-gray-600">
                <li><a href="{{ route('user.dashboard') }}" class="text-green-500 hover:text-green-700">Beranda</a></li>
                <li><span class="mx-2">/</span></li>
                <li><a href="{{ route('user.history') }}" class="text-green-500 hover:text-green-700">Riwayat Pesanan</a></li>
                <li><span class="mx-2">/</span></li>
                <li>Detail Pesanan</li>
            </ol>
        </nav>
    </div>
    <section class="p-6">
        <div class="container">
            <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Detail Pesanan</h1>
        </div>
    </section>

    <section class="py-8 mx-4">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="p-4 bg-green-600 text-white font-bold text-lg border-b">
                Informasi Pesanan
            </div>
            <div class="p-4">
                <div class="mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">ID Pesanan: {{ $order->order_id }}</h2>
                    <p class="text-gray-600 text-lg mt-2">Tanggal: {{ $order->created_at->format('d F Y H:i') }}</p>
                    <p class="text-gray-600 text-lg mt-2">Status Pembayaran: 
                        <span class="inline-block rounded px-3 py-1 text-sm font-semibold {{ $order->status == 'paid' ? 'bg-green-500' : ($order->status == 'pending' ? 'bg-yellow-500' : 'bg-red-500') }} text-white">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>
                </div>

                <div class="mb-4 mt-4 border-t-2">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Alamat Pengiriman</h3>
                    <p class="text-gray-600 text-base">{{ $order->user->name }}</p>
                    <p class="text-gray-600 text-base">{{ $order->user->addresses->first()->phone_number }}</p>
                    <p class="text-gray-600 text-base">{{ $order->shipment ? $order->shipment->detail_address : 'Alamat pengiriman tidak tersedia' }}</p>
                    <p class="text-gray-600 text-lg font-semibold mt-2">Kurir: {{ $order->shipment ? $order->shipment->courier_name . ' - ' . $order->shipment->courier_service : 'Kurir tidak tersedia' }}</p>
                    <p class="text-gray-600 text-lg font-semibold">Status Pengiriman: 
                        <span class="inline-block rounded px-3 py-1 text-sm font-semibold {{ $order->shipment->status == 'completed' ? 'bg-green-500' : ($order->shipment->status == 'shipped' ? 'bg-greenSecondary' : 'bg-yellow-500') }} text-white">{{ ucfirst($order->shipment->status) }}</span></p>
                </div>

                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Detail Produk</h3>
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full text-center border-collapse">
                            <thead>
                                <tr class="bg-gray-200 text-gray-700 text-sm uppercase tracking-wider">
                                    <th class="px-4 py-2 border">Produk</th>
                                    <th class="px-4 py-2 border">Jumlah</th>
                                    <th class="px-4 py-2 border">Harga Satuan</th>
                                    <th class="px-4 py-2 border">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->order_detail as $detail)
                                <tr class="hover:bg-gray-100">
                                    <td class="px-4 py-2 border text-gray-800 text-left">{{ $detail->product_name }}</td>
                                    <td class="px-4 py-2 border text-gray-800">{{ $detail->quantity }}</td>
                                    <td class="px-4 py-2 border text-gray-800">Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                                    <td class="px-4 py-2 border text-gray-800">Rp {{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mb-4 w-[25rem]">
                    <h3 class="text-xl font-semibold  border-b border-gray-300 text-gray-800 mb-4">Rincian Harga</h3>
                    <div class="text-gray-800">
                        <div class="flex items-center text-base py-1">
                            <p class="flex-1">Subtotal Harga Barang</p>
                            <p class="w-40 text-right">Rp. {{ number_format($order->order_detail->sum(function($detail) { return $detail->price * $detail->quantity; }), 0, ',', '.') }}</p>
                        </div>
                        <div class="flex items-center text-base py-1">
                            <p class="flex-1">Biaya Layanan</p>
                            <p class="w-40 text-right">Rp. 2.000</p>
                        </div>
                        <div class="flex items-center text-base py-1">
                            <p class="flex-1">Ongkos Kirim</p>
                            <p class="w-40 text-right">Rp. {{ number_format($order->shipment->shipping_cost, 0, ',', '.') }}</p>
                        </div>
                        <div class="flex items-center font-bold text-xl py-2 border-t border-gray-300 mt-2">
                            <p class="flex-1">Total Pembayaran</p>
                            <p class="w-40 text-right">Rp. {{ number_format($order->order_detail->sum(function($detail) { return $detail->price * $detail->quantity; }) + $order->shipment->shipping_cost + 2000, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
                <form action="">
                    <button type="submit" class="px-6 mt-4 py-2 bg-greenSecondary text-white font-semibold text-lg rounded-md hover:text-white hover:bg-greenHover">
                        Konfirmasi Pesanan</button>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection