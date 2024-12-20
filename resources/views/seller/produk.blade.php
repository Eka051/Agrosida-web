@extends('components.template')
@include('components.sidebarSeller')
@section('title', 'Kelola Produk')
@section('content')

<div class="ml-64 mt-20 flex-1">
    <section class="py-8">
        <div class="flex justify-between items-center mx-8">
            <h2 class="text-3xl font-semibold text-gray-800">Produk Anda</h2>
            <button class="bg-greenPrimary px-4 py-2 rounded-md font-medium hover:bg-primaryHover transition duration-300"
                onclick="window.location.href='{{ route('seller.add-product') }}'">Tambah Produk</button>
        </div>
        <div class="flex ml-8 mt-4 items-center w-full md:w-1/3 border border-gray-400 rounded-lg focus-within:ring-2 focus-within:ring-green-500">
            <span class="iconify text-2xl text-gray-600 ml-2" data-icon="icon-park-twotone:search"></span>
            <input type="text" id="searchInput" placeholder="Cari produk Anda"
            class="p-2 rounded-lg w-full focus:outline-none" onkeyup="filterProducts()">
        </div>
        <div id="productContainer" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 mt-6 mx-8">
            @foreach ($products as $product)
            <div class="product-item border rounded-lg p-4 bg-white shadow-lg flex flex-col h-full">
                <div class="flex justify-center">
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->product_name }}"
                        class="w-full h-48 size-48 object-cover rounded-t-lg">
                </div>
                <div class="mt-4 flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg text-gray-800 text-left">{{ $product->product_name }}</h3>
                    </div>
                    <div class="flex flex-col justify-between h-full">
                        <div>
                            <p class="font-bold text-xl text-left">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                            <p class="text-base font-medium text-left mt-2">Stok: {{ $product->stock }}</p>
                        </div>
                        <div class="flex space-x-2 mt-4">
                            <div class="mt-2">
                                <a href="{{ route('seller.edit-product', $product->id) }}"
                                    class="bg-yellow-500 text-white px-6 py-[0.7rem] font-medium rounded hover:bg-yellow-600 transition duration-300 flex-1 text-center">
                                    Edit
                                </a>
                            </div>
                            <form action="{{ route('seller.delete-product', $product->id) }}" method="POST" id="delete-product-{{ $product->id }}"
                                class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="bg-red-500 text-white font-medium text-center px-4 py-2 rounded hover:bg-red-700 focus:outline-none flex-1">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>

<script>
    function filterProducts() {
        const searchInput = document.getElementById('searchInput').value.toLowerCase();
        const productItems = document.querySelectorAll('.product-item');

        productItems.forEach(item => {
            const productName = item.querySelector('h3').textContent.toLowerCase();
            if (productName.includes(searchInput)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    function deleteProduct(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Produk yang dihapus tidak dapat dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus produk!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-product-' + id).submit();
            }
        });
    }
</script>

@endsection