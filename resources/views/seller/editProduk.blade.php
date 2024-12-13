@extends('components.template')
@include('components.sidebarSeller')
@section('title', 'Edit Produk')
@section('content')
<div class="ml-56 flex-1">

    <section class="bg-primaryBg p-8 text-center mt-20">
        <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Edit Produk</h1>
        <p class="text-gray-600 mt-2 lg:text-lg">Edit informasi produk yang ada di toko Anda</p>
    </section>

    <section class="py-8 mx-4">
        <div class="bg-white shadow rounded-lg p-6">
            <form action="{{ route('seller.update-product', $product->id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <label for="image" class="block text-xl font-medium text-gray-700">Gambar Produk</label>
                    <input type="file" name="image" id="image" accept="image/*"
                        class="w-full text-base p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                    @error('image')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror

                    <div class="mt-4">
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="Gambar Produk"
                            class="w-32 h-32 object-contain rounded-md">
                    </div>
                    <p class="text-sm text-gray-500 mt-2">Jika ingin mengganti gambar, pilih gambar baru di atas.</p>
                </div>
                <div>
                    <label for="product_name" class="block text-xl font-medium text-gray-700">Nama Produk</label>
                    <input type="text" name="product_name" id="product_name" required
                        class="w-full text-base p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400"
                        value="{{ old('product_name', $product->product_name) }}">
                    @error('product_name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="stock" class="block text-xl font-medium text-gray-700">Stok Produk</label>
                    <input type="number" name="stock" id="stock" required min="0"
                        class="w-full text-base p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400"
                        value="{{ old('stock', $product->stock) }}">
                    @error('stock')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="weight" class="block text-xl font-medium text-gray-700">Berat (gram)</label>
                    <input type="number" name="weight" id="weight" required 
                        class="mt-1 block w-full rounded-md border p-3 focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Masukkan berat produk (gram) produk">
                </div>
                <div>
                    <label for="category" class="block text-xl font-medium text-gray-700">Kategori Produk</label>
                    <div class="relative">
                        <select name="category_id" id="category" required
                            class="w-full text-base p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                            <option value="" disabled selected>Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->category_id }}"
                                    {{ $category->category_id == $product->category_id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('category_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="price" class="block text-xl font-medium text-gray-700">Harga (Rp)</label>
                    <input type="text" name="price" id="price" required
                        class="w-full text-base p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400"
                        value="Rp {{ old('price', number_format($product->price, 0, ',', '.')) }}">
                    @error('price')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-xl font-medium text-gray-700">Deskripsi</label>
                    <textarea name="description" id="description" rows="4" required
                        class="w-full text-base p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-green-500 text-white px-6 py-2 rounded-md text-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>

@if (session('error'))
<script>
    Swal.fire({
            icon: 'error',
            title: 'Update Produk Gagal',
            text: '{{ session('error') }}',
            confirmButtonColor: '#ff0000',
            confirmButtonText: 'OK'
        });
</script>
@endif

<script>
    document.getElementById('price').addEventListener('input', function() {
        let value = this.value.replace(/[^0-9]/g, '');
        if (value) {
            this.value = 'Rp ' + value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        } else {
            this.value = '';
        }
    });
</script>
@endsection