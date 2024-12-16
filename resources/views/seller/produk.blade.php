@extends('components.template')
@include('components.sidebarSeller')
@section('title', 'Kelola Produk')
@section('content')

<div class="ml-64 mt-20 flex-1">
    <section class="py-8">
        <div class="flex justify-between items-center mx-8">
            <h2 class="text-3xl font-semibold text-gray-800">Produk Anda</h2>
            <button class="bg-greenPrimary px-4 py-2 rounded-md font-medium hover:bg-primaryHover transition duration-300"
                onclick="window.location.href='{{ route('seller.add-product') }}'">Tambah Produk</button>
        </div>
        <div class="flex justify-center mt-4">
            <input type="text" id="searchInput" placeholder="Cari produk Anda"
                class="p-2 rounded-l border border-gray-300 w-full md:w-1/3 focus:outline-none focus:ring-2 focus:ring-green-500" onkeyup="filterProducts()">
            <button class="bg-green-500 text-white px-4 py-2 rounded-r hover:bg-green-600 transition duration-300" onclick="filterProducts()">Search</button>
        </div>
        <div id="productContainer" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-8 gap-6 mt-6 mx-8">
            @foreach ($products as $product)
            <div class="product-item border rounded-lg p-4 bg-white shadow-lg flex flex-col h-full">
            <div class="flex justify-center">
                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->product_name }}"
                class="w-full h-48 size-48 object-cover rounded-t-lg">
            </div>
            <div class="mt-4 flex-1 flex flex-col justify-between">
                <div>
                <h3 class="text-lg text-gray-800 text-left">{{ $product->product_name }}</h3>
                <p class="font-bold text-xl text-left">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                <p class="text-base font-medium text-left mt-2">Stok: {{ $product->stock }}</p>
                </div>
                <div class="flex space-x-2 mt-4">
                <a href="{{ route('seller.edit-product', $product->id) }}"
                    class="bg-yellow-500 text-white px-4 py-1 rounded hover:bg-yellow-600 transition duration-300">Edit</a>
                <button type="button" class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600 transition duration-300"
                    onclick="deleteProduct('{{ route('seller.delete-product', $product->id) }}')">
                    Delete
                </button>
                </div>
            </div>
            </div>
            @endforeach
        </div>
    </section>
</div>

<script>
    function filterProducts() {
        const searchInput = document.getElementById('searchInput').value.toLowerCase();
        const productItems = document.querySelectorAll('.product-item');

        productItems.forEach(item => {
            const productName = item.querySelector('h3').textContent.toLowerCase();
            if (productName.includes(searchInput)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }
</script>

@endsection