@extends('components.template')
@include('components.sidebarSeller')
@section('title', 'Detail Pesanan')
@section('content')
<div class="ml-64 flex-1">
    <section class="mt-24 font-bold ml-6 text-gray-800 lg:text-4xl">Detail Pesanan</h1>
        <p class="text-gray-600 mt-2 font-normal lg:text-lg">Lihat detail pesanan customer</p>
    </section>

    <section class="py-8 mx-4">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="p-4 bg-green-600 text-white font-bold text-lg border-b flex justify-between items-center">
                Informasi Pesanan
            </div>
            <div class="p-6 flex justify-between items-start">
                <div class="">
                    <h2 class="text-xl font-semibold text-gray-800">ID Pesanan: {{ $order->order_id }}</h2>
                    <p class="text-gray-600 text-lg mt-2">Tanggal: {{ $order->created_at->format('d F Y H:i') }}</p>
                    <p class="text-gray-600 text-lg mt-2">Status Pesanan:
                        <span class="inline-block rounded px-3 py-1 text-sm font-semibold {{ $order->status == 'processed' ? 'bg-yellow-500' : ($order->status == 'shipped' ? 'bg-green-500' : 'bg-red-500') }} text-white">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>
                   
                    <p class="text-gray-600 text-lg mt-2">Status Pembayaran:
                        <span class="inline-block rounded px-3 py-1 text-sm font-semibold {{ $order->payment->status == 'paid' ? 'bg-green-500' : ($order->payment->status == 'pending' ? 'bg-yellow-500' : ($order->payment->status == 'failed' ? 'bg-red-500' : 'bg-gray-500')) }} text-white">
                            {{ ucfirst($order->payment->status) }}
                        </span>
                    </p>
                </div>
                <div class="flex">
                    @if ($order->status == 'processed')
                        <form action="{{ route('seller.order.cancel', $order->shipment->order_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="order_id" value="{{ $order->order_id }}">
                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-2">
                                Batalkan
                            </button>
                        </form>
                        <form action="{{ route('seller.shipment.confirm', $order->shipment->order_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="order_id" value="{{ $order->order_id }}">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Kirim Pesanan
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="p-6">
                <div class="mb-4 border-t-2 pt-4">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Alamat Pengiriman</h3>
                    <p class="text-gray-600 text-base">{{ $order->user->name }}</p>
                    <p class="text-gray-600 text-base">{{ $order->user->addresses->first()->phone_number }}</p>
                    <p class="text-gray-600 text-base">{{ $order->shipment ? $order->shipment->detail_address : 'Alamat pengiriman tidak tersedia' }}</p>
                    <p class="text-gray-600 text-lg font-semibold mt-2">Kurir: {{ $order->shipment->courier_name }} - {{ $order->shipment->courier_service }}</p>
                    <p class="text-gray-600 text-lg font-semibold">Status Pengiriman:
                        <span class="inline-block rounded px-3 py-1 text-sm font-semibold {{ $order->shipment->status == 'processing' ? 'bg-yellow-500' : ($order->shipment->status == 'shipping' ? 'bg-green-500' : ($order->shipment->status == 'delivered' ? 'bg-green-500' : 'bg-red-500')) }} text-white">
                            {{ ucfirst($order->shipment->status) }}
                        </span>
                    </p>
                </div>

                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Detail Produk</h3>
                    <div class="overflow-x-auto mt-4">
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
                    <h3 class="text-xl font-semibold border-b border-gray-300 text-gray-800 mb-4">Rincian Harga</h3>
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
            </div>
        </div>
    </section>
</div>
@endsection