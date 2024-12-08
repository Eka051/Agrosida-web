@extends('components.template')
@section('title', 'Pembayaran')
@section('content')

<div class="container mx-auto p-8">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-semibold mb-4">Pembayaran Pesanan</h1>
        <p><strong>Nomor Pesanan:</strong> {{ $order->id }}</p>
        <p><strong>Total Pembayaran:</strong> Rp. {{ number_format($order->total_price) }}</p>

        <div class="my-6">
            <h2 class="text-lg font-semibold mb-2">Scan QRIS</h2>
            <div class="flex justify-center">
                @if($snapToken)
                    <div id="qris-container"></div>
                @else
                    <p class="text-red-500">Token pembayaran tidak tersedia. Silakan coba lagi.</p>
                @endif
            </div>
            <p class="text-gray-600 mt-4 text-center">
                Gunakan aplikasi e-wallet seperti GoPay, ShopeePay, DANA, atau LinkAja untuk menyelesaikan pembayaran.
            </p>
        </div>
    </div>
</div>

<script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if ("{{ $snapToken }}") {
            snap.pay("{{ $snapToken }}", {
                onSuccess: function(result) {
                    alert("Pembayaran Berhasil!");
                },
                onPending: function(result) {
                    alert("Menunggu Pembayaran...");
                },
                onError: function(result) {
                    alert("Pembayaran Gagal!");
                }
            });
        }
    });
</script>
@endsection
