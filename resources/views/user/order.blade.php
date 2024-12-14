@extends('components.template')
@include('components.sidebarUser')
@section('title', 'Checkout Produk')
@section('content')
<script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>

<div class="ml-64 flex-1">
    <!-- Hero Section -->
    <section class="bg-primaryBg p-8 text-center mt-20">
        <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Checkout Produk</h1>
        <p class="text-gray-600 mt-2 lg:text-lg">Konfirmasi pesanan Anda dan isi detail pengiriman</p>
    </section>
    <form action="{{ route('payment.process') }}" method="POST">
        @csrf
        <section class="py-8 mx-4">
            <div class="grid lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-800 border-b pb-4">Detail Produk</h2>
                    <div class="mt-4 space-y-4">
                        <div class="flex justify-between items-center border-b pb-4">
                            <div class="flex items-center space-x-4">
                                <div class="block">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <p class="font-bold text-base mb-5">{{ $product->user->store->name }}</p>
                                    <div class="w-20 h-20 flex justify-center items-center">
                                        <img src="{{ asset('storage/' . $product->image_path) }}" alt=""
                                            class="object-contain w-28 h-28">
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <p class="text-gray-800">{{ $product->product_name }}</p>
                                    <p class="text-lg font-bold text-gray-600">Rp. {{ number_format($product->price, 0,
                                        ',', '.') }} </p>
                                </div>
                            </div>
                            <div class="block items-center space-x-2 p-3 mt-10">
                                <div class="flex items-center border border-gray-300 rounded-lg">
                                    <button type="button" id="decrease-quantity" class="text-gray-600 px-2">
                                        <span class="iconify" data-icon="mynaui:minus" data-inline="false"
                                            style="width: 24px; height: 24px; color: #000;"></span>
                                    </button>
                                    <input type="number" id="quantity" name="quantity" value="1" min="1"
                                        class="w-16 border-0 text-center h-10">
                                    <button type="button" id="increase-quantity" class="text-gray-600 px-2">
                                        <span class="iconify" data-icon="mynaui:plus" data-inline="false"
                                            style="width: 24px; height: 24px; color: #000;"></span>
                                    </button>
                                </div>
                                <p class="text-gray-800 text-lg mt-4 font-medium"> Total: <span
                                        id="product-total">{{ number_format($product->price, 0, ',', '.') }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-800 border-b pb-4">Ringkasan Pesanan</h2>
                    <div class="mt-4">
                        <div class="flex justify-between text-gray-800">
                            <p>Total Harga (<span id="quantity-display">1</span> Barang)</p>
                            <p id="subtotal">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                        <div class="flex justify-between text-gray-800 mt-2">
                            <p>Ongkos Kirim</p>
                            <p id="shipping-cost">Rp. 0</p>
                        </div>
                        <div class="flex justify-between text-gray-800 mt-2">
                            <p>Biaya Layanan</p>
                            <p id="service-charge">Rp 2.000</p>
                        </div>
                        <div class="flex justify-between font-bold text-gray-800 mt-4">
                            <p>Total</p>
                            <p>Rp. <span id="total">{{ number_format($product->price, 0, ',', '.') }}</span></p>
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
                    <select name="shipping_option" class="w-full mt-1 border border-gray-300 rounded-lg px-4 py-2 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-300" id="courier">
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

    document.getElementById('decrease-quantity').addEventListener('click', function () {
        var quantity = document.getElementById('quantity');
        if (parseInt(quantity.value) > 1) {
            quantity.value = parseInt(quantity.value) - 1;
            updateTotals();
        }
    });

    document.getElementById('increase-quantity').addEventListener('click', function () {
        var quantity = document.getElementById('quantity');
        quantity.value = parseInt(quantity.value) + 1;
        updateTotals();
    });

    document.getElementById('quantity').addEventListener('input', function () {
        var quantityInput = document.getElementById('quantity');
        var value = quantityInput.value;
        if (!/^\d+$/.test(value)) {
            quantityInput.value = value.replace(/\D/g, '');
        }
    });

    document.getElementById('quantity').addEventListener('blur', function () {
        var quantityInput = document.getElementById('quantity');
        var quantity = parseInt(quantityInput.value)||1;
        if (quantity < 1) {
            quantityInput.value = 1;
        }
        quantityInput.value = quantity;
        updateTotals();
    });

    document.getElementById('quantity').addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            updateTotals();
        }
    });

    document.getElementById('address').addEventListener('change', fetchCourier);

    document.getElementById('courier').addEventListener('change', function () {
        var selectedOption = this.options[this.selectedIndex];
        var cost = selectedOption.getAttribute('data-cost');
        document.getElementById('shipping-cost').innerText = 'Rp. ' + new Intl.NumberFormat('id-ID').format(cost);
        updateTotals();
    });

    function fetchCourier() {
    const origin = {{$product->user->addresses->first()->city_id}};
    const destination = document.getElementById('address').value;
    const quantity = parseInt(document.getElementById('quantity').value) || 1;
    const weight = {{$product->weight}} * quantity;

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
                options += `<option value="${courier.courier}-${courier.service}" data-cost="${courier.cost}">
                    ${courier.courier} - ${courier.service} (${courier.description}) - Rp${new Intl.NumberFormat('id-ID').format(courier.cost)} (ETD: ${courier.etd} days)
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
        var quantity = document.getElementById('quantity').value || 1;
        var price = {{ $product->price }};
        var serviceCharge = 2000;
        var shippingCost = document.getElementById('shipping-cost');
        var ongkir = shippingCost ? parseInt(shippingCost.innerText.replace('Rp. ', '').replace(/\./g, '')) : 0;
        var subtotal = price * quantity;
        var total = subtotal + serviceCharge + ongkir;

        document.getElementById('quantity-display').innerText = quantity;
        document.getElementById('product-total').innerText = 'Rp. ' + new Intl.NumberFormat('id-ID').format(price * quantity);
        document.getElementById('subtotal').innerText = new Intl.NumberFormat('id-ID').format(subtotal);
        document.getElementById('service-charge').innerText = 'Rp. ' + new Intl.NumberFormat('id-ID').format(serviceCharge);
        document.getElementById('total').innerText = new Intl.NumberFormat('id-ID').format(total);
    }

    document.addEventListener('DOMContentLoaded', loadProductDetails);
</script>
@endsection
