@extends('components.template')
@section('title', 'Pembayaran')
@section('content')
<div class="container mx-auto p-8 mt-20">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-semibold mb-4">Pembayaran Pesanan</h1>
        <p><strong>Nomor Pesanan:</strong> {{ $order->order_id }}</p>
        <p><strong>Total Pembayaran:</strong> Rp. {{ number_format($total, 0, ',', '.') }}</p>

        <div class="mt-6">
            <!-- Container untuk Snap Payment -->
            <div id="snap-container" class="w-full"></div>
            <button id="pay-button" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mt-4">
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