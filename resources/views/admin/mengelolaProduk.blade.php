@extends('components.template')
@include('components.sidebarAdmin')
@section('title', 'Kelola Produk')
@section('content')
<div class="ml-56 flex-1">
    <!-- Hero Section -->
    <section class="bg-primaryBg p-8 text-center mt-20">
        <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Kelola Produk</h1>
        <p class="text-gray-600 mt-2 lg:text-lg">Kelola produk yang tersedia di marketplace</p>
    </section>
     <!-- Pencarian -->
     <form method="GET" action="{{ route('admin.view-product') }}" class="p-4 bg-gray-100">
        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari produk atau kategori..."
               class="px-4 py-2 border rounded w-full focus:ring-2 focus:ring-green-500 focus:outline-none">
        <button type="submit" class="mt-4 bg-green-500 text-white px-8 py-2 rounded hover:bg-green-600">Cari</button>
    </form>

    <div class="mx-5 mt-4">
        <a href="{{ route('admin.add-product') }}" class="bg-greenPrimary text-white px-6 py-3 rounded-lg shadow-lg hover:bg-greenSecondary">
            Tambah Produk
        </a>
    </div>

    <!-- Tabel Produk -->
    <section class="py-8 mx-4">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="p-4 bg-green-500 text-white font-bold text-lg border-b">
                Daftar Produk
            </div>

            <div class="overflow-x-auto">
                <table class="table-auto w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700 text-sm uppercase tracking-wider">
                            <th class="px-4 py-2 border">ID Produk</th>
                            <th class="px-4 py-2 border">Gambar</th>
                            <th class="px-4 py-2 border">Nama Produk</th>
                            <th class="px-4 py-2 border">Kategori</th>
                            <th class="px-4 py-2 border">Deskripsi</th>
                            <th class="px-4 py-2 border">Harga</th>
                            <th class="px-4 py-2 border">Stok</th>
                            <th class="px-4 py-2 border">Status</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-gray-800">{{ $product->id }}</td>
                            <td class="px-4 py-2 border">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                     class="w-16 h-16 object-cover">
                            </td>
                            <td class="px-4 py-2 border text-gray-800">{{ $product->name }}</td>
                            <td class="px-4 py-2 border text-gray-800">{{ $product->category->name ?? '-' }}</td>
                            <td class="px-4 py-2 border text-gray-800">{{ $product->description }}</td>
                            <td class="px-4 py-2 border text-gray-800">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 border text-gray-800">{{ $product->stock }}</td>
                            <td class="px-4 py-2 border">
                                <span class="px-2 py-1 rounded text-white 
                                    {{ $product->is_discontinue ? 'bg-red-500' : 'bg-green-500' }}">
                                    {{ $product->is_discontinue ? 'Discontinue' : 'Tersedia' }}
                                </span>
                            </td>
                            <td class="px-4 py-2 border">
                                <a href="{{ route('admin.delete-product', $product->id) }}"
                                   class="bg-red-500 text-white px-4 py-1 rounded text-sm hover:bg-red-600">
                                   Hapus
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="px-4 py-6 text-center text-gray-500">
                                Tidak ada produk yang tersedia saat ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
