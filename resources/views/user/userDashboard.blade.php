@extends('components.template')
@include('components.sidebarUser')
@section('title', 'Beranda Pestisida')

@section('content')
<div class="ml-64 pt-20 px-6 bg-gray-50">
    {{-- Hero Section --}}
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
                        class="flex-grow px-4 py-3 rounded-l-lg border-2 border-green-300 focus:outline-none focus:ring-2 focus:ring-green-500"
                    >
                    <button class="bg-white text-green-700 px-6 py-3 rounded-r-lg hover:bg-green-100 transition duration-300">
                        Cari
                    </button>
                </div>
            </div>
        </div>
    </section>

    {{-- Produk Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
        @foreach ($products as $product)
        <div class="bg-white rounded-xl border border-gray-200 shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2">
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
                
                <div class="flex justify-between items-center mb-3">
                    <span class="text-xl font-bold text-green-600">
                        Rp. {{ number_format($product->price, 0, ',', '.') }}
                    </span>
                    <span class="text-sm text-gray-600">
                        Stok: {{ $product->stock }}
                    </span>
                </div>
                
                <div class="flex items-center text-gray-600 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="text-sm">{{ $product->user->store->name }}</span>
                </div>
                
                <div class="flex space-x-4">
                    <a 
                        href="{{ route('user.order', $product->id) }}" 
                        class="flex-grow text-base text-center items-center bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-300">
                        Beli
                    </a>
                    <form action="{{ route('user.cart.add', $product->id) }}" method="POST" class="inline-block">
                        @csrf
                        <button 
                            type="submit" 
                            class="bg-green-100 text-green-700 p-2 rounded-lg hover:bg-green-200 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
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
            // Implementasi logika pencarian sederhana
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