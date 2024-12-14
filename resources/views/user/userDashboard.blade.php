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

    <!-- Categories Section -->
    <section class="py-8 bg-gray-50">
        <h2 class="text-xl lg:text-2xl font-semibold text-center text-gray-800">Kategori Pilihan</h2>
        <div class="flex overflow-x-auto gap-4 px-4 mt-6 scrollbar-hide">
            @foreach(['Pestisida', 'Alat Pertanian', 'Bibit Tanaman', 'Mirip yang kamu cek'] as $category)
            <button class="flex-shrink-0 px-4 py-2 rounded-full text-white font-medium" style="background-color: {{ ['#FFA500', '#32CD32', '#FF69B4', '#00BFFF'][$loop->index] }}">
                {{ $category }}
            </button>
            @endforeach
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-8">
        <h2 class="text-xl lg:text-2xl font-semibold text-center text-gray-800">Produk Terbaru</h2>
        <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4 mt-6 px-4">
            @foreach(range(1, 12) as $i)
            <div class="border rounded-lg p-4 bg-white shadow hover:shadow-lg transition relative">
                <div class="bg-gray-200 h-24 w-full rounded-lg lg:h-32"></div>
                <h3 class="mt-4 text-sm font-medium text-gray-800 lg:text-base">Product Name {{ $i }}</h3>
                <p class="text-green-600 text-sm lg:text-base font-semibold mt-2">Rp{{ number_format(15000 + $i * 5000, 0, ',', '.') }}</p>
                <p class="text-gray-500 text-sm">Jakarta</p>
                <div class="absolute top-2 left-2 bg-yellow-500 text-white px-2 py-1 text-xs rounded">Promo</div>
                <button class="mt-2 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Beli</button>
            </div>
            @endforeach
        </div>
    </section>
</div>
@endsection
