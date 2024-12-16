@extends('components.template')
@include('components.sidebarSeller')
@section('title', 'Tambah Produk')

@section('content')
<div class="ml-64 flex-1 mt-[4.5rem]">
    <section class="bg-gray-100 p-4">
        <div class="container ml-6">
            <nav class="text-lg">
                <ol class="list-reset flex text-gray-600">
                    <li><a href="{{ route('seller.dashboard') }}" class="text-green-500 hover:text-green-700">Beranda</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li>Tambah Produk</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="p-8 mt-2">
        <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Tambah Produk</h1>
        <p class="text-gray-600 mt-2 lg:text-lg">Tambah produk baru untuk toko Anda</p>
    </section>

    <section class="py-8 mx-4">
        <div class="bg-white border shadow-lg rounded-lg p-6 mx-auto">
            <form action="{{ route('seller.save-product') }}" method="POST" enctype="multipart/form-data" id="productForm" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="image" class="block text-xl font-medium text-gray-700">Gambar Produk</label>
                        <img id="imgPreview" class="mt-4 w-32 h-32 object-contain rounded-md border hidden">
                        <input type="file" name="image" id="image" 
                            class="mt-1 block w-full rounded-md border p-3 focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div>
                        <label for="product_name" class="block text-xl font-medium text-gray-700">Nama Produk</label>
                        <input type="text" name="product_name" id="product_name" placeholder="Masukkan nama produk" 
                            class="w-full text-base p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" required>
                    </div>
                    <div>
                        <label for="stock" class="block text-xl font-medium text-gray-700">Stok Produk</label>
                        <input type="number" name="stock" id="stock" required 
                            class="mt-1 block w-full rounded-md border p-3 focus:outline-none focus:ring-2 focus:ring-green-500"
                            placeholder="Masukkan jumlah stok produk">
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
                                class="mt-1 block w-full text-base p-3 rounded-md border focus:outline-none focus:ring-2 focus:ring-green-500 pr-10">
                                <option value="" disabled selected>Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->category_id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-2 flex justify-between items-center">
                            <button type="button" id="addCategoryBtn" class="text-base ml-4 font-medium text-green-600 hover:text-greenPrimary">Tambah Kategori Baru</button>
                        </div>
                        <div id="newCategoryDiv" class="hidden mt-2">
                            <label for="new_category" class="block text-xl font-medium text-gray-700">Kategori Baru</label>
                            <input type="text" id="new_category" name="new_category" class="mt-1 p-3 block w-full rounded-md border focus:outline-none focus:ring-green-500" placeholder="Masukkan nama kategori baru">
                        </div>
                    </div>
                    <div>
                        <label for="price" class="block text-xl font-medium text-gray-700">Harga (Rp)</label>
                        <input type="text" name="price" id="price" required
                            class="mt-1 block w-full rounded-md border p-3 focus:outline-none focus:ring-2 shadow-sm focus:border-green-500 focus:ring-green-500"
                            placeholder="Contoh: 50000">
                    </div>
                    <div class="col-span-1 md:col-span-2">
                        <label for="description" class="block text-xl font-medium text-gray-700">Deskripsi</label>
                        <textarea name="description" id="description" rows="4" required
                            class="mt-1 p-3 text-base block w-full rounded-md border focus:outline-none focus:ring-2 focus:ring-green-500 resize-none" placeholder="Masukkan deskripsi produk"></textarea>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-green-500 text-white px-6 py-3 rounded-md text-xl font-semibold hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                        Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('addCategoryBtn').addEventListener('click', function() {
        document.getElementById('newCategoryDiv').classList.remove('hidden');
        document.getElementById('category').disabled = true;
    });

    document.getElementById('productForm').addEventListener('submit', function(event) {
        let categoryInput = document.getElementById('new_category').value.trim();
        let categoryDropdown = document.getElementById('category').value;

        if (!categoryDropdown && !categoryInput) {
            event.preventDefault();
            Swal.fire('Error', 'Pilih kategori atau masukkan kategori baru', 'error');
        }
    });

    document.getElementById('price').addEventListener('input', function() {
        let value = this.value.replace(/[^0-9]/g, '');
        if (value) {
            this.value = 'Rp ' + value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        } else {
            this.value = '';
        }
    });

    document.getElementById('image').addEventListener('change', function(event) {
        let reader = new FileReader();
        reader.onload = function(e) {
            let imgPreview = document.getElementById('imgPreview');
            imgPreview.src = e.target.result;
            imgPreview.classList.remove('hidden');
        }
        reader.readAsDataURL(event.target.files[0]);
    });
</script>
@endsection
