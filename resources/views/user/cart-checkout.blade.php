@extends('components.template')
@include('components.sidebarUser')
@section('title', 'Checkout Produk')
@section('content')
<script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>

<div class="ml-64 flex-1">
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
                                        <button type="button" class="text-gray-600 px-2 decrease-quantity" data-id="{{ $item->id }}" data-price="{{ $item->product->price }}">
                                            <span class="iconify" data-icon="mynaui:minus" data-inline="false" style="width: 24px; height: 24px; color: #000;"></span>
                                        </button>
                                        <input type="number" name="quantities[{{ $item->id }}]" value="{{ $item->quantity }}" min="1" class="quantity w-16 border-0 text-center h-10" data-price="{{ $item->product->price }}">
                                        <button type="button" class="text-gray-600 px-2 increase-quantity" data-id="{{ $item->id }}" data-price="{{ $item->product->price }}">
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
                            <p id="shipping-cost">Rp. 0</p>
                        </div>
                        <div class="flex justify-between text-gray-800 mt-2">
                            <p>Biaya Layanan</p>
                            <p>Rp. 2.000</p>
                        </div>
                        <div class="flex justify-between font-bold text-gray-800 mt-4">
                            <p>Total</p>
                            <p>Rp. <span id="total">{{ number_format($cartItems->sum(function($item) { return $item->product->price * $item->quantity; }) + 2000, 0, ',', '.') }}</span></p>
                        </div>
                    </div>

                    <h2 class="text-xl font-semibold text-gray-800 border-b pb-4 mt-8">Informasi Pengiriman</h2>
                    @if($addresses->isEmpty())
                    <p class="text-gray-600">Anda belum memiliki alamat pengiriman.</p>
                    <a href="{{ route('user.add-address') }}" onclick="saveProductDetails()"
                        class="w-full bg-green-600 text-white font-medium py-3 rounded-lg hover:bg-green-700 text-center block mt-4">
                        Tambah Alamat
                    </a>
                    @else
                    <form action="{{ route('user.address.store') }}" method="POST" class="mt-4 space-y-4" id="address-form">
                        @csrf
                        <div>
                            <label for="address" class="block mt-2 text-gray-600">Pilih Alamat</label>
                            <select id="address" name="address"
                                class="w-full mb-5 border border-gray-300 rounded-lg px-4 py-2 mt-1 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-300">
                                <option value="" disabled selected>Pilih Alamat Tujuan</option>
                                @foreach($addresses as $address)
                                <option value="{{ $address->id }}">{{ $address->getFullAddressAttribute() }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                    
                    <div>
                    <label for="courier" class="block text-gray-600">Pilih Kurir Pengiriman</label>
                    <select required name="shipping_option" class="w-full mt-1 border border-gray-300 rounded-lg px-4 py-2 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-300" id="courier">
                        <option disabled selected>Pilih Kurir Pengiriman</option>
                    </select>
                    </div>
                    <a href="{{ route('user.add-address') }}"
                        class="w-full bg-green-600 text-white font-medium py-3 rounded-lg hover:bg-green-700 text-center block mt-4">
                        Tambah Alamat Lain
                    </a>
                    @endif
                    <button type="submit"
                        class="w-full bg-greenSecondary text-white font-medium py-3 rounded-lg hover:bg-greenSecondary/80 hover:text-white mt-4">
                        Bayar Sekarang
                    </button>
                </div>
            </div>
        </section>
    </form>
</div>

<script>
    function saveProductDetails() {
        var productDetails = {
            productId: document.querySelector('input[name="product_id"]').value,
            quantity: document.getElementById('quantity').value
        };
        sessionStorage.setItem('productDetails', JSON.stringify(productDetails));
    }

    function loadProductDetails() {
        var productDetails = JSON.parse(sessionStorage.getItem('productDetails'));
        if (productDetails) {
            document.querySelector('input[name="product_id"]').value = productDetails.productId;
            document.getElementById('quantity').value = productDetails.quantity;
            updateTotals();
        }
    }

    document.querySelectorAll('.decrease-quantity').forEach(button => {
        button.addEventListener('click', function () {
            var quantityInput = document.querySelector(`input[name="quantities[${this.dataset.id}]"]`);
            if (parseInt(quantityInput.value) > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
                updateTotals();
            }
        });
    });

    document.querySelectorAll('.increase-quantity').forEach(button => {
        button.addEventListener('click', function () {
            var quantityInput = document.querySelector(`input[name="quantities[${this.dataset.id}]"]`);
            quantityInput.value = parseInt(quantityInput.value) + 1;
            updateTotals();
        });
    });

    document.querySelectorAll('.quantity').forEach(input => {
        input.addEventListener('input', function () {
            var value = this.value;
            if (!/^\d+$/.test(value)) {
                this.value = value.replace(/\D/g, '');
            }
        });

        input.addEventListener('blur', function () {
            var quantity = parseInt(this.value) || 1;
            if (quantity < 1) {
                this.value = 1;
            }
            this.value = quantity;
            updateTotals();
        });

        input.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                updateTotals();
            }
        });
    });

    document.getElementById('address').addEventListener('change', fetchCourier);

    document.getElementById('courier').addEventListener('change', function () {
        var selectedOption = this.options[this.selectedIndex];
        var cost = selectedOption.value.split('-')[2];
        document.getElementById('shipping-cost').innerText = 'Rp. ' + new Intl.NumberFormat('id-ID').format(cost);
        updateTotals();
    });

    function fetchCourier() {
        const origin = {{$cartItems->first()->product->user->addresses->first() ? $cartItems->first()->product->user->addresses->first()->city_id : 'null'}};
        const destination = document.getElementById('address').value;
        const weight = {{$cartItems->sum(function($item) { return $item->product->weight * $item->quantity; })}};

        if (!destination) {
            document.getElementById('courier').innerHTML = '<option disabled selected>Pilih Kurir Pengiriman</option>';
            document.getElementById('shipping-cost').innerText = 'Rp. 0';
            return;
        }

        fetch('/api/order/get-courier', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                origin: origin,
                destination: destination,
                weight: weight
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const couriers = data.data; 
                let options = '<option disabled selected>Pilih Kurir Pengiriman</option>';
                couriers.forEach(courier => {
                    options += `<option value="${courier.courier}-${courier.service}-${courier.cost}" data-cost="${courier.cost}">
                        ${courier.courier} - ${courier.service} (${courier.description}) - Rp${new Intl.NumberFormat('id-ID').format(courier.cost)} (Est: ${courier.etd} hari)
                    </option>`;
                });
                document.getElementById('courier').innerHTML = options;
            } else {
                document.getElementById('courier').innerHTML = '<option disabled>Kurir tidak tersedia</option>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('courier').innerHTML = '<option disabled>Kurir tidak tersedia</option>';
        });
    }

    function updateTotals() {
        let subtotal = 0;

        document.querySelectorAll('.quantity').forEach(input => {
            const price = parseInt(input.dataset.price);
            const quantity = parseInt(input.value);
            subtotal += price * quantity;
        });

        const serviceCharge = 2000;
        const shippingCost = document.getElementById('shipping-cost');
        const ongkir = shippingCost ? parseInt(shippingCost.innerText.replace('Rp. ', '').replace(/\./g, '')) : 0;
        const total = subtotal + serviceCharge + ongkir;

        document.getElementById('subtotal').innerText = new Intl.NumberFormat('id-ID').format(subtotal);
        document.getElementById('total').innerText = new Intl.NumberFormat('id-ID').format(total);
    }

    document.addEventListener('DOMContentLoaded', loadProductDetails);
</script>
@endsection
