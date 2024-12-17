@extends('components.template')
@include('components.sidebarSeller')
@section('title', 'Pesanan Seller')
@section('content')
<div class="ml-64 flex-1 overflow-x-auto">
    <section class="bg-gray-100 p-4">
        <div class="container mx-auto">
            <nav class="text-base">
                <ol class="list-reset flex text-gray-600">
                    <li><a href="{{ route('seller.dashboard') }}" class="text-green-500 hover:text-green-700">Home</a>
                    </li>
                    <li><span class="mx-2">/</span></li>
                    <li>Pesanan Seller</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="p-8">
        <div class="container">
            <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Pesanan Anda</h1>
            <p class="text-gray-600 mt-2 lg:text-lg">Kelola pesanan dari pelanggan Anda di sini</p>
        </div>
    </section>

    <section class="py-8 mx-4">
        <div class="bg-white shadow rounded-lg overflow-hidden">
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
                        @forelse ($orders as $order)
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-gray-800">{{ $order->order_id }}</td>
                            <td class="px-4 py-2 border text-gray-800">{{ $order->user->name }}</td>
                            <td class="px-4 py-2 border text-gray-800">{{ $order->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="px-4 py-2 border text-gray-800">Rp {{
                                number_format($order->order_detail->first()->total, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 border text-gray-800">
                                <span
                                    class="inline-block rounded px-3 py-1 text-sm font-semibold {{ $order->status == 'shipped' ? 'bg-green-500' : ($order->status == 'pending' ? 'bg-yellow-500' : 'bg-red-500') }} text-white">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="inline-flex">
                                    <a href="{{ route('seller.view-order-detail', $order->order_id) }}"
                                        class="bg-green-500 text-white px-4 py-1 rounded text-sm hover:bg-green-600">
                                        Detail
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                                Tidak ada pesanan saat ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection