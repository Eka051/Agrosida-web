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
        <h2 class="text-xl lg:text-2xl font-semibold text-center text-gray-800">Produk</h2>
        <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4 mt-6 mx-4">
            @for ($i = 1; $i <= 12; $i++) <!-- Menampilkan 12 produk -->
            <div class="border rounded-lg p-4 text-center bg-white shadow">
                <div class="bg-gray-200 h-24 w-24 mx-auto lg:h-32 lg:w-32"></div>
                <h3 class="mt-4 text-sm font-medium text-gray-800 lg:text-base">Product Name {{ $i }}</h3>
                <p class="text-blue-600 text-sm lg:text-base">${{ 15 + $i * 5 }}.00</p>
            </div>
            @endfor
        </div>
    </section>
</div>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Login Berhasil',
        text: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif
@endsection
