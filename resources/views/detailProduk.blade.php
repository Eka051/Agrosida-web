@extends('components.template')
@include('components.sidebarUser')
@section('title', 'Katalog')

@section('content')
<body class="bg-gray-100">
    @include('components.nav2')
    <div class="flex mt-12 justify-center">
        <div class="flex-1 max-w-[80rem] p-4 bg-white shadow-lg mt-20 mb-10 rounded-lg">
            <nav class="text-sm text-gray-500 mb-4">
                <a href="{{ route('user.dashboard') }}" class="hover:underline text-green-500">Dashboard</a> >
                <a href="#" class="hover:underline">Detail Produk</a>
            </nav>

            <div class="flex flex-col lg:flex-row gap-6">
                <div class="flex-1">
                    <img src="{{ asset('storage/' . $product->image_path) }}" 
                    alt="{{ $product->product_name }}" class="w-full border rounded-lg mb-4">
                </div>

                <div class="flex-1">
                    <h1 class="text-2xl font-bold mb-2">{{ $product->product_name }}</h1>
                    <p class="text-3xl text-orange-600 font-bold mb-4">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>

                    <div class="mb-3 space-y-1 text-base">
                        <p><span class="font-medium">Jenis:</span>  {{ $product->category->name }}</p>
                        <p><span class="font-medium">Ukuran:</span> {{ $product->weight }} gram</p>
                    </div>

                    <div class="mb-4">
                        <p class="text-gray-600 mb-1 text-base">Stok: <span class="font-bold text-red-500">{{ $product->stock }}</span></p>
                        <p class="text-base font-semibold">Deskripsi:</p>
                        <p class="text-gray-600">{{ $product->description }}</p>
                    </div>

                    <div class="flex items-center gap-3 mb-4">
                        <a href="{{ route('user.order', $product->id) }}" 
                            class="flex items-center justify-center text-base font-medium bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition duration-300">
                            Beli Sekarang
                        </a>
                        <form action="{{ route('user.cart.add', $product->id) }}" method="POST" class="flex-grow">
                            @csrf
                            <button 
                                type="submit" 
                                class="flex items-center mt-4 w-16 justify-center text-base font-medium bg-green-500 text-white py-2 px-3 rounded-lg hover:bg-green-600 transition duration-300">
                                <span class="iconify text-xl" data-icon="solar:cart-large-bold-duotone" data-inline="false"></span>
                            </button>
                        </form>
                    </div>

                    <div class="text-base text-gray-600">
                        <p>Dijual oleh: <span class="font-medium">{{ $product->user->store->name }}</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
