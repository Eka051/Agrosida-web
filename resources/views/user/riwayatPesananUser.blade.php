@extends('components.template')
@include('components.sidebarUser')
@section('title', 'Riwayat Pesanan')
@section('content')
<div class="ml-64 flex-1 mt-[4.5rem]">
    <section class="bg-gray-100 p-4">
        <div class="container ml-6">
            <nav class="text-lg">
                <ol class="list-reset flex text-gray-600">
                    <li><a href="{{ route('user.dashboard') }}" class="text-green-500 hover:text-green-700">Beranda</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li>Riwayat Pesanan</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="p-8">
        <div class="container">
            <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Riwayat Pesanan Anda</h1>
            <p class="text-gray-600 mt-2 lg:text-lg">Pantau dan cek riwayat pesanan yang telah Anda buat</p>
        </div>
    </section>

    <section class="py-8 mx-4">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table-auto w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700 text-sm uppercase tracking-wider">
                            <th class="px-4 py-2 border">ID Pesanan</th>
                            <th class="px-4 py-2 border">Tanggal</th>
                            <th class="px-4 py-2 border">Total</th>
                            <th class="px-4 py-2 border">Status Pembayaran</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-gray-800">{{ $order->order_id }}</td>
                            <td class="px-4 py-2 border text-gray-800">{{ $order->created_at->translatedFormat('d F Y H:i') }}</td>
                            <td class="px-4 py-2 border text-gray-800">Rp. {{ number_format($order_totals[$order->order_id], 0, ',', '.') }}</td>
                            <td class="px-4 py-2 border text-gray-800">
                                <span class="inline-block rounded px-3 py-1 text-sm font-semibold {{ $order->payment->status == 'pending' ? 'bg-yellow-500' : ($order->payment->status == 'paid' ? 'bg-green-500' : 'bg-red-500') }} text-white">
                                    {{ ucfirst($order->payment->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('user.order-detail', $order->order_id) }}" 
                                       class="bg-green-500 text-white px-4 py-2 rounded text-sm hover:bg-green-600">
                                        Lihat Detail
                                    </a>
                                    @if($order->payment->status == 'pending')
                                    <form action="{{ route('payment.pending', ['order_id' => $order->order_id]) }}" method="POST">
                                        @csrf
                                        <button class="bg-blue-500 text-white px-4 py-2 rounded text-sm mt-[0.8rem] hover:bg-blue-600">
                                            Bayar
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                Tidak ada riwayat pesanan saat ini.
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