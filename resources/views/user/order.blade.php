@extends('components.template')
@include('components.sidebarUser')
@section('title', 'Checkout Produk')
@section('content')
<script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>

<div class="ml-56 flex-1">
    <!-- Hero Section -->
    <section class="bg-primaryBg p-8 text-center mt-20">
        <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Checkout Produk</h1>
        <p class="text-gray-600 mt-2 lg:text-lg">Konfirmasi pesanan Anda dan isi detail pengiriman</p>
    </section>
    <form action="{{ route('user.order.payment') }}" method="POST">
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
                                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="" class="object-contain w-28 h-28">  
                                </div>
                            </div>
                            <div class="mt-5">
                                <p class="text-gray-800">{{ $product->product_name }}</p>
                                <p class="text-lg font-bold text-gray-600">Rp. {{ number_format($product->price, 0, ',', '.') }} </p>
                            </div>
                        </div>
                        <div class="block items-center space-x-2 p-3 mt-10">
                            <div class="flex items-center border border-gray-300 rounded-lg">
                                <button type="button" id="decrease-quantity" class="text-gray-600 px-2">
                                    <span class="iconify" data-icon="mynaui:minus" data-inline="false" style="width: 24px; height: 24px; color: #000;"></span>
                                </button>
                                <input type="number" id="quantity" name="quantity" value="1" min="1" class="w-16 border-0 text-center h-10">
                                <button type="button" id="increase-quantity" class="text-gray-600 px-2">
                                    <span class="iconify" data-icon="mynaui:plus" data-inline="false" style="width: 24px; height: 24px; color: #000;"></span>
                                </button>
                            </div>
                            <p class="text-gray-800 text-lg mt-4 font-medium"> Total: Rp. <span id="product-total">{{ number_format($product->price, 0, ',', '.') }}</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 border-b pb-4">Ringkasan Pesanan</h2>
                <div class="mt-4">
                    <div class="flex justify-between text-gray-800">
                        <p>Total Harga (<span id="quantity-display">1</span> Barang)</p>
                        <p>Rp. <span id="subtotal">{{ number_format($product->price, 0, ',', '.') }}</span></p>
                    </div>
                    <div class="flex justify-between text-gray-800 mt-2">
                        <p>Ongkos Kirim</p>
                        <p>Rp20,000</p>
                    </div>
                    <div class="flex justify-between font-bold text-gray-800 mt-4">
                        <p>Total</p>
                        <p>Rp<span id="total">{{ number_format($product->price + 20000, 0, ',', '.') }}</span></p>
                    </div>
                </div>

                <h2 class="text-xl font-semibold text-gray-800 border-b pb-4 mt-8">Informasi Pengiriman</h2>
                @if($addresses->isEmpty())
                    <p class="text-gray-600">Anda belum memiliki alamat pengiriman.</p>
                    <a href="{{ route('user.add-address') }}" class="w-full bg-blue-500 text-white font-medium py-3 rounded-lg hover:bg-blue-600 text-center block mt-4">
                        Tambah Alamat
                    </a>
                @else
                    <form action="{{ route('user.address.store') }}" method="POST" class="mt-4 space-y-4">
                        @csrf
                        <div>
                            <label for="address" class="block text-gray-600">Pilih Alamat</label>
                            <select id="address" name="address_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 bg-gray-100" disabled>
                                @foreach($addresses as $address)
                                    <option value="{{ $address->id }}">{{ $address->getFullAddressAttribute() }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="w-full bg-green-500 text-white font-medium py-3 rounded-lg hover:bg-green-600">
                            Gunakan Alamat Ini
                        </button>
                    </form>
                    <a href="{{ route('user') }}" class="w-full bg-blue-500 text-white font-medium py-3 rounded-lg hover:bg-blue-600 text-center block mt-4">
                        Tambah Alamat Lain
                    </a>
                @endif
                <button type="submit" class="w-full bg-greenSecondary text-white font-medium py-3 rounded-lg hover:bg-greenPrimary mt-4">
                    Bayar Sekarang
                </button>
            </div>
        </div>
    </section>
    </form>
</div>

<script>
    document.getElementById('decrease-quantity').addEventListener('click', function() {
        var quantityInput = document.getElementById('quantity');
        var quantity = parseInt(quantityInput.value) || 1;
        if (quantity > 1) {
            quantityInput.value = quantity - 1;
            updateTotals();
        }
    });

    document.getElementById('increase-quantity').addEventListener('click', function() {
        var quantityInput = document.getElementById('quantity');
        var quantity = parseInt(quantityInput.value) || 1;
        quantityInput.value = quantity + 1;
        updateTotals();
    });

    document.getElementById('quantity').addEventListener('input', function() {
        var quantityInput = document.getElementById('quantity');
        var value = quantityInput.value;
        if (!/^\d+$/.test(value)) {
            quantityInput.value = value.replace(/[^\d]/g, '');
        }
    });

    document.getElementById('quantity').addEventListener('blur', function() {
        var quantityInput = document.getElementById('quantity');
        var quantity = parseInt(quantityInput.value) || 1;
        if (quantity < 1) {
            quantityInput.value = 1;
        }
        quantityInput.value = quantity;
        updateTotals();
    });

    document.getElementById('quantity').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            updateTotals();
        }
    });

    function updateTotals() {
        var quantity = parseInt(document.getElementById('quantity').value);
        var price = {{ $product->price }};
        var subtotal = quantity * price;
        var ongkir = 20000;
        var total = subtotal + ongkir;

        document.getElementById('product-total').innerText = subtotal.toLocaleString('id-ID');
        document.getElementById('quantity-display').innerText = quantity;
        document.getElementById('subtotal').innerText = subtotal.toLocaleString('id-ID');
        document.getElementById('total').innerText = total.toLocaleString('id-ID');
    }
</script>
@endsection