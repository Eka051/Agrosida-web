@extends('components.template')
@include('components.sidebarSeller')
@section('title', 'Seller Dashboard')
@section('content')

<div class="ml-48 flex-1">
    <section class="bg-green-100 p-8 text-center mt-20">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard Penjual</h1>
        <p class="text-gray-600">Kelola produk Anda dengan mudah</p>
        <div class="mt-4 flex justify-center">
            <input type="text" placeholder="Cari produk Anda"
                class="p-2 rounded-l border border-gray-300 w-1/2 md:w-1/3">
            <button class="bg-green-500 text-white px-4 py-2 rounded-r">Search</button>
        </div>
    </section>

    <section class="py-8">
        <div class="flex justify-between items-center mx-4">
            <h2 class="text-3xl font-semibold text-gray-800">Produk Anda</h2>
            <button class="bg-blue-500 text-white px-4 py-2 rounded"
                onclick="window.location.href='{{ route('seller.add-product') }}'">Tambah Produk</button>
        </div>
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
                </div>
                <div class="flex space-x-2 right-0 mt-4">
                    <a href="{{ route('seller.edit-product', $product->id) }}"
                        class="bg-yellow-500 text-white px-4 py-1 rounded">Edit</a>
                    <button type="button" class="bg-red-500 text-white px-4 py-1 rounded"
                        onclick="deleteProduct('{{ route('seller.delete-product', $product->id) }}')">
                        Delete
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>


<script>
    function deleteProduct(actionUrl) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Tindakan ini tidak dapat dibatalkan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = actionUrl;

                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                form.appendChild(csrfToken);

                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'POST';
                form.appendChild(methodInput);

                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>

@endsection