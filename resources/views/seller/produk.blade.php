@extends('components.template')
@include('components.sidebarSeller')
@section('title', 'Kelola Produk')
@section('content')

<div class="ml-64 flex-1">
    <div class="mt-4 flex justify-center">
        <input type="text" placeholder="Cari produk Anda"
            class="p-2 rounded-l border border-gray-300 w-1/2 md:w-1/3 focus:outline-none focus:ring-2 focus:ring-green-500">
        <button class="bg-green-500 text-white px-4 py-2 rounded-r hover:bg-green-600 transition duration-300">Search</button>
    </div>

    <section class="py-8">
        <div class="flex justify-between items-center mx-8">
            <h2 class="text-3xl font-semibold text-gray-800">Produk Anda</h2>
            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300"
                onclick="window.location.href='{{ route('seller.add-product') }}'">Tambah Produk</button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-6 mx-8">
            @foreach ($products as $product)
            <div class="border rounded-lg p-4 bg-white shadow-lg flex flex-col h-full">
                <div class="flex justify-center">
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->product_name }}"
                        class="w-full h-40 object-contain">
                </div>
                <div class="mt-4 flex-1">
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
            @endforeach
        </div>
    </section>
</div>
@endsection