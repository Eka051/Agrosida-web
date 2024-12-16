@extends('components.template')
@include('components.sidebarUser')
@section('title', 'Beranda Pestisida')

@section('content')
<div class="ml-64 pt-20 px-6 bg-gray-50">
    <section class="mb-10 bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="relative bg-gradient-to-r from-green-600 to-green-800 p-8 lg:p-12">
            <div class="max-w-3xl mx-auto text-center text-white">
                <h1 class="text-3xl md:text-4xl font-bold mb-4">
                    Solusi Pestisida Profesional untuk Petani
                </h1>
                <p class="text-lg mb-6 text-green-100">
                    Temukan produk berkualitas untuk meningkatkan hasil pertanian Anda
                </p>
                <div class="flex max-w-xl mx-auto">
                    <input 
                        type="text" 
                        placeholder="Cari pestisida..." 
                        class="flex-grow text-black px-4 py-3 rounded-l-lg border-2 border-green-300 focus:outline-none focus:ring-2 focus:ring-green-500"
                    >
                    <button class="bg-white text-green-700 px-6 py-3 rounded-r-lg hover:bg-green-100 transition duration-300">
                        Cari
                    </button>
                </div>
            </div>
        </div>
    </section>

    <div class="grid sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-6">
        @foreach ($products as $product)
        <div class="bg-white rounded-xl max-w-60 border border-gray-200 shadow-md hover:shadow-lg transition-all duration-300 transform">
            <div class="relative">
                <img 
                    src="{{ asset('storage/' . $product->image_path) }}" 
                    alt="{{ $product->product_name }}"
                    class="w-full h-56 object-fill rounded-t-xl"
                >
                @if($product->stock <= 5)
                    <span class="absolute top-3 right-3 bg-red-500 text-white px-3 py-1 rounded-full text-xs">
                        Stok Terbatas
                    </span>
                @endif
            </div>
            
            <div class="p-5">
                <h3 class="text-lg font-semibold text-gray-900 mb-2 truncate">
                    {{ $product->product_name }}
                </h3>
                
                <div class="block mb-3">
                    <span class="text-xl font-bold text-green-600">
                        Rp. {{ number_format($product->price, 0, ',', '.') }}
                    </span>
                    <span class="text-sm text-gray-600">
                        Terjual: {{ $sold[$product->id] ?? 0 }}
                    </span>
                </div>
                
                <div class="flex items-center text-gray-600 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="text-sm">{{ $product->user->store->name }} | {{ $product->user->addresses->first()->province->province_name }}</span>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="{{ route('user.order', $product->id) }}" 
                        class="flex-grow flex items-center justify-center text-lg font-medium bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition duration-300">
                        Beli
                    </a>
                    <form action="{{ route('user.cart.add', $product->id) }}" method="POST" class="flex-grow">
                        @csrf
                        <button 
                            type="submit" 
                            class="flex mt-4 items-center justify-center w-full text-lg font-medium bg-greenPrimary text-white px-2 py-[0.7rem] rounded-lg hover:bg-green-200 transition duration-300">
                            <span class="iconify text-2xl text-greenSecondary" data-icon="solar:cart-large-bold-duotone" data-inline="false"></span>
                        </button>
                    </form>
                </div>
                

            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('input[type="text"]');
        const searchButton = document.querySelector('button');
        
        searchButton.addEventListener('click', function() {
            const searchTerm = searchInput.value.toLowerCase();
            const products = document.querySelectorAll('.grid > div');
            
            products.forEach(product => {
                const productName = product.querySelector('h3').textContent.toLowerCase();
                product.style.display = productName.includes(searchTerm) ? 'block' : 'none';
            });
        });
    });
</script>
@endpush