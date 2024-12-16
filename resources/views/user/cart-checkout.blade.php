@extends('components.template')
@include('components.sidebarUser')
@section('title', 'Checkout Produk')
@section('content')
<script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>

<div class="ml-56 flex-1">
    <section class="bg-primaryBg p-8 text-center mt-20">
        <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Checkout Produk</h1>
        <p class="text-gray-600 mt-2 lg:text-lg">Konfirmasi pesanan Anda dan isi detail pengiriman</p>
    </section>

    <form action="{{ route('cart.payment') }}" method="POST">
        @csrf
        @foreach($cartItems as $item)
            @if(isset($item->product))
                <input type="hidden" name="product_id[]" value="{{ $item->product->id }}">
                <input type="hidden" name="quantity[]" value="{{ $item->quantity }}">
            @endif
        @endforeach
        @csrf
        <section class="py-8 mx-4">
            <div class="grid lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-800 border-b pb-4">Detail Produk</h2>
                    <div class="mt-4 space-y-4">
                        @foreach($cartItems as $item)
                        @if(isset($item->product))
                            <div class="flex justify-between items-center border-b pb-4">
                                <div class="flex items-center space-x-4">
                                    <div class="block">
                                        <p class="font-bold text-base mb-5">
                                            {{ $item->product->user->store->name ?? '' }}
                                        </p>
                                        <div class="w-20 h-20 flex justify-center items-center">
                                            <img src="{{ asset('storage/' . $item->product->image_path) }}" alt="Gambar Produk" class="object-contain w-28 h-28">
                                        </div>
                                    </div>
                                    <div class="mt-5">
                                        <p class="text-gray-800">{{ $item->product->product_name }}</p>
                                        <p class="text-lg font-bold text-gray-600">Rp. {{ number_format($item->product->price, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                <div class="block items-center space-x-2 p-3 mt-10">
                                    <div class="flex items-center border border-gray-300 rounded-lg">
                                        <button type="button" class="text-gray-600 px-2 decrease-quantity" data-id="{{ $item->id }}" data-price="{{ $item->price }}">
                                            <span class="iconify" data-icon="mynaui:minus" data-inline="false" style="width: 24px; height: 24px; color: #000;"></span>
                                        </button>
                                        <input type="number" name="quantities[{{ $item->id }}]" value="{{ $item->quantity }}" min="1" class="quantity w-16 border-0 text-center h-10" data-price="{{ $item->price }}">
                                        <button type="button" class="text-gray-600 px-2 increase-quantity" data-id="{{ $item->id }}" data-price="{{ $item->price }}">
                                            <span class="iconify" data-icon="mynaui:plus" data-inline="false" style="width: 24px; height: 24px; color: #000;"></span>
                                        </button>
                                    </div>
                                    <p class="text-gray-800 text-lg mt-4 font-medium"> Total: Rp. <span class="product-total" data-id="{{ $item->product->id }}">{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</span></p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    
                    </div>
                </div>
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-800 border-b pb-4">Ringkasan Pesanan</h2>
                    <div class="mt-4" id="order-summary">
                        <div class="flex justify-between text-gray-800">
                            <p>Total Harga</p>
                            <p>Rp. <span id="subtotal">{{ number_format($cartItems->sum(function($item) { return $item->product->price * $item->quantity; }), 0, ',', '.') }}</span></p>
                        </div>
                        <div class="flex justify-between text-gray-800 mt-2">
                            <p>Ongkos Kirim</p>
                            <p>Rp. 20.000</p>
                        </div>
                        <div class="flex justify-between text-gray-800 mt-2">
                            <p>Biaya Layanan</p>
                            <p>Rp. 2.000</p>
                        </div>
                        <div class="flex justify-between font-bold text-gray-800 mt-4">
                            <p>Total</p>
                            <p>Rp<span id="total">{{ number_format($cartItems->sum(function($item) { return $item->product->price * $item->quantity; }) + 22000, 0, ',', '.') }}</span></p>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-greenSecondary text-white font-medium py-3 rounded-lg hover:bg-greenPrimary mt-4">
                        Bayar Sekarang
                    </button>
                </div>
            </div>
        </section>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const orderSummary = document.querySelector('.lg\\:col-span-2'); 

        if (orderSummary) {
            orderSummary.addEventListener('click', function (event) {
                const button = event.target.closest('.decrease-quantity, .increase-quantity');
                if (button) {
                    console.log('Button clicked:', button);
                    const productId = button.dataset.id;
                    const price = parseInt(button.dataset.price);
                    const quantityInput = document.querySelector(`input[name="quantities[${productId}]"]`);

                    if (!quantityInput) {
                        console.error('Quantity input not found for productId:', productId);
                        return;
                    }

                    let quantity = parseInt(quantityInput.value) || 1;

                    if (button.classList.contains('decrease-quantity') && quantity > 1) {
                        quantity--;
                    } else if (button.classList.contains('increase-quantity')) {
                        quantity++;
                    }

                    quantityInput.value = quantity;

                    const totalElement = document.querySelector(`.product-total[data-id="${productId}"]`);
                    if (totalElement) {
                        totalElement.textContent = (price * quantity).toLocaleString('id-ID');
                    }

                    updateTotals();
                }
            });
        } else {
            console.error('Order summary container not found');
        }

        function updateTotals() {
            let subtotal = 0;

            // Calculate subtotal from all products
            document.querySelectorAll('.quantity').forEach(input => {
                const price = parseInt(input.dataset.price);
                const quantity = parseInt(input.value);
                subtotal += price * quantity;
            });

            const ongkir = 20000;
            const serviceFee = 2000;
            const total = subtotal + ongkir + serviceFee;

            // Update summary section
            const subtotalElement = document.getElementById('subtotal');
            const totalElement = document.getElementById('total');

            if (subtotalElement) {
                subtotalElement.textContent = subtotal.toLocaleString('id-ID');
            } else {
                console.error('Subtotal element not found'); // Debugging
            }

            if (totalElement) {
                totalElement.textContent = total.toLocaleString('id-ID');
            } else {
                console.error('Total element not found'); // Debugging
            }
        }
    });
</script>


@endsection
