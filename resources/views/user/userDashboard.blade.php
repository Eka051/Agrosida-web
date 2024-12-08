@extends('components.template')
@include('components.sidebarUser')
@section('title', 'Beranda')
@section('content')
<div class="ml-56 flex-1">
    <!-- Hero Section -->
    <section class="bg-primaryBg p-8 text-center mt-20 lg:mt-20">
        <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Beragam Pilihan Pestisida Berkualitas untuk Pertanian Anda</h1>
        <p class="text-gray-600 mt-2 lg:text-lg">Dapatkan Pestisida Terbaik Sesuai Kebutuhan Anda</p>
        <div class="mt-4 flex flex-col items-center lg:flex-row lg:justify-center">
            <input type="text" placeholder="Cari produk anda" 
                   class="p-2 rounded-t lg:rounded-l lg:rounded-r-none border border-gray-300 w-3/4 md:w-1/2 lg:w-1/3">
            <button class="bg-green-500 text-white px-4 py-2 rounded-b lg:rounded-r lg:rounded-l-none mt-2 lg:mt-0">Search</button>
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-6 mt-6 mx-4">
            @foreach ($products as $product)
            <div class="border rounded-lg p-4 bg-white shadow flex flex-col h-full">
                <div class="flex justify-center">
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->product_name }}"
                        class="w-full h-40 object-contain">
                </div>
                <div class="mt-4 flex-1">
                    <h3 class="text-base text-gray-800 text-left">{{ $product->product_name }}</h3>
                    <p class="font-bold text-2xl text-left">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                    <p class="text-base font-medium text-left mt-4">Stok: {{ $product->stock }}</p>
                    <p class="text-base font-medium text-left mt-4">{{ $product->user->store->name }}</p>
                </div>
                <button class="py-3 rounded-md px-2 bg-greenPrimary text-white font-bold hover:text-white hover:bg-green-700"><a href="{{ route('user.order', [$product->id]) }}">Beli Produk</a></button>
            </div>
            @endforeach
        </div>
    </section>
</div>


@endsection
