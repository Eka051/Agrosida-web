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
                <div class="relative max-w-xl mx-auto">
                    <div class="relative">
                        <input type="text" 
                               id="searchInput" 
                               placeholder="Cari produk..." 
                               class="w-full px-6 py-3 rounded-full text-gray-800 bg-white/95 backdrop-blur-sm border-2 border-green-100 focus:border-green-300 focus:ring-2 focus:ring-green-200 focus:outline-none transition-all duration-300"
                        >
                        <span class="absolute right-4 top-1/2 transform -translate-y-1/2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="productsGrid" class="grid sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
        @foreach ($products as $product)
        <div class="product-card bg-white rounded-xl max-w-60 border border-gray-200 shadow-md hover:shadow-lg transition-all duration-300 transform cursor-pointer"
        data-name="{{ strtolower($product->product_name) }}" data-id="{{ $product->id }}">
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

            <div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900 truncate">
                        {{ $product->product_name }}
                    </h3>
                    <p class="text-base mb-4">{{ $product->category->name }}</p>
                    <div class="block mb-2">
                        <span class="text-xl font-bold text-green-600">
                            Rp. {{ number_format($product->price, 0, ',', '.') }}
                        </span>
                    </div>
            
                    <div class="flex items-center text-gray-600 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        @if($product->user && $product->user->store && $product->user->addresses->first())
                            <span class="text-sm">{{ $product->user->store->name }} | {{ $product->user->addresses->first()->province->province_name }}</span>
                        @else
                            <span class="text-sm">Informasi tidak tersedia</span>
                        @endif
                    </div>

                    <div class="flex items-center gap-4">
                        <a href="{{ route('user.order', $product->id) }}"
                            class="flex items-center justify-center text-lg font-medium bg-green-600 text-white px-[3.75rem] py-2 rounded-lg hover:bg-green-700 transition duration-300">
                            Beli
                        </a>
                        <form action="{{ route('user.cart.add', $product->id) }}" method="POST" class="w-full">
                            @csrf
                            <button
                                type="submit"
                                class="flex items-center text-lg font-medium bg-greenPrimary text-white py-[0.6rem] px-2 mt-4 rounded-lg hover:bg-green-200 transition duration-300">
                                <span class="iconify text-2xl text-greenSecondary" data-icon="solar:cart-large-bold-duotone" data-inline="false"></span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        @endforeach
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const productCards = document.querySelectorAll('.product-card');

        productCards.forEach(card => {
            card.addEventListener('click', function() {
                const productId = this.getAttribute('data-id');
                window.location.href = `/product/detail/${productId}`;
            });
        });
    });
    </script>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const productCards = document.querySelectorAll('.product-card');
    let debounceTimer;

    const debounce = (callback, time) => {
        window.clearTimeout(debounceTimer);
        debounceTimer = window.setTimeout(callback, time);
    };

    searchInput.addEventListener('input', function() {
        debounce(() => {
            const searchTerm = this.value.toLowerCase().trim();

            productCards.forEach(card => {
                const productName = card.getAttribute('data-name');
                
                if (searchTerm === '' || productName.includes(searchTerm)) {
                    card.style.display = '';
                    card.style.opacity = '1';
                    card.style.transform = 'scale(1)';
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'scale(0.8)';
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 300);
                }
            });

            // Check if no results found
            const visibleCards = Array.from(productCards).filter(card => 
                card.style.display !== 'none'
            );

            const noResultsElement = document.getElementById('noResults');
            if (visibleCards.length === 0) {
                if (!noResultsElement) {
                    const message = document.createElement('div');
                    message.id = 'noResults';
                    message.className = 'col-span-full text-center py-8 text-gray-500';
                    message.innerHTML = `
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="mt-4 text-lg">Tidak ada produk yang ditemukan</p>
                    `;
                    document.getElementById('productsGrid').appendChild(message);
                }
            } else if (noResultsElement) {
                noResultsElement.remove();
            }
        }, 300);
    });
});
</script>
@endsection