@extends('components.template')
@include('components.sidebarUser')
@section('title', 'Beranda')
@section('content')
<div class="ml-64 mt-16 flex-1">
    <section class="relative bg-cover bg-center p-16 text-center" style="background-image: url('/path-to-hero-image.jpg');">
        <div class="absolute inset-0 bg-greenPrimary"></div>
        <div class="relative z-10">
            <h1 class="text-4xl font-bold text-white lg:text-5xl leading-tight">Beragam Pilihan Pestisida Berkualitas untuk Pertanian Anda</h1>
            <p class="text-lg text-white mt-4 lg:text-xl">Dapatkan Pestisida Terbaik Sesuai Kebutuhan Anda</p>
            <div class="mt-6 flex justify-center">
                <input type="text" placeholder="Cari produk" 
                       class="p-3 rounded-l-lg border border-gray-300 w-3/4 md:w-1/2 lg:w-1/3 focus:outline-none focus:ring-2 focus:ring-green-500">
                <button class="bg-green-600 text-white px-5 py-3 rounded-r-lg hover:bg-green-700 transition duration-300">Cari</button>
            </div>
        </div>
    </section>

    <section class="py-12 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($products as $product)
                <div class="border rounded-lg bg-white shadow-lg transition-transform transform hover:scale-105 flex flex-col">
                    <div class="relative">
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->product_name }}"
                            class="w-full h-64 object-contain rounded-t-lg">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-4">
                            <h3 class="text-lg font-semibold text-white">{{ $product->product_name }}</h3>
                        </div>
                    </div>
                    <div class="p-6 flex flex-col justify-between flex-1">
                        <div>
                            <p class="text-xl font-bold text-green-600 mt-2">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                            <p class="text-sm text-gray-600 mt-2">Stok: {{ $product->stock }}</p>
                            <p>Terjual: {{ $product->orderDetails->sum('quantity') }}</p>
                            <div class="flex items-center mt-4">
                                <span class="iconify text-green-500" data-icon="streamline:store-1" style="width: 24px; height: 24px;"></span>
                                <p class="text-sm text-gray-700 ml-2">{{ $product->user->store->name }}</p>
                            </div>
                        </div>
                        <div class="flex space-x-2 mt-6">
                            <div class="flex-1">
                                <a href="{{ route('user.order', $product->id) }}" 
                                   class="py-4 px-6 rounded-md bg-green-600 text-white font-bold text-center hover:bg-green-700 transition duration-300 inline-flex items-center justify-center w-full">
                                    Beli Produk
                                </a>
                            </div>
                            <div>
                                <form action="{{ route('user.cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button class="px-4 py-4 rounded-md bg-green-500 text-white flex items-center justify-center hover:bg-green-600 transition duration-300 w-full">
                                        <span class="iconify text-[22px]" data-icon="mdi:cart" data-inline="false"></span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection
