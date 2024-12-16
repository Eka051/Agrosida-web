@extends('components.template')
@section('title', 'Pembayaran')
@section('content')
<div class="container mx-auto p-8 mt-20">
    <div class="bg-white w-[50rem] m-auto border border-gray-100 shadow-lg rounded-lg p-6">
        <h1 class="text-3xl font-bold mb-6 text-center">Pembayaran Pesanan</h1>
        <div class="mb-4 mt-4">
            <p class="text-xl"><strong>Nomor Pesanan:</strong> {{ $order->order_id }}</p>
            <p class="text-xl"><strong>Nama:</strong> {{ $order->user->name }}</p>
            <p class="text-xl"><strong>Total Pembayaran:</strong> Rp. {{ number_format($total, 0, ',', '.') }}</p>
        </div>
        <div>
            <h2 class="text-xl font-bold border-b mb-4">Detail Pembayaran</h2>
            <div class="flex justify-between mb-2">
                <p class="text-lg">Harga Produk</p>
                <p class="text-lg font-bold">Rp. {{ number_format($total, 0, ',', '.') }}</p>
            </div>
            <div class="flex justify-between mb-2">
                <p class="text-lg">Biaya Pengiriman</p>
                <p class="text-lg font-bold">Rp. 0</p>
            </div>
            <div class="flex justify-between mb-2">
                <p class="text-lg">Total Pembayaran</p>
                <p class="text-lg font-bold">Rp. {{ number_format($total, 0, ',', '.') }}</p>
            </div>
        </div>
        <div class="mt-6">
            <div id="snap-container" class="w-full"></div>
            <button id="pay-button" class="w-full bg-greenPrimary text-white px-6 py-3  text-base font-medium rounded-lg hover:bg-green-400 transition duration-300 mt-4">
                Bayar Sekarang
            </button>
        </div>
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
        snap.pay('{{ $snapToken }}', {
          onSuccess: function(result){
            Swal.fire({
                icon: 'success',
                title: 'Pembayaran Berhasil',
                text: 'Pesanan Anda telah berhasil dibayar',
                confirmButtonColor: '#A2E554',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = '{{ route('user.dashboard') }}';
            });
          },
          onPending: function(result){
            Swal.fire({
                icon: 'info',
                title: 'Pembayaran Pending',
                text: 'Pesanan Anda sedang diproses',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = '{{ route('user.dashboard') }}';
            });
          },
          onError: function(result){
            Swal.fire({
                icon: 'error',
                title: 'Pembayaran Gagal',
                text: 'Pesanan Anda gagal dibayar',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = '{{ route('user.dashboard') }}';
            });
          }
        });
      };
</script>

@endsection