@extends('components.template')
@include('components.sidebarAdmin')
@section('title', 'Tambah Produk')

@section('content')
<div class="ml-56 flex-1">
    <!-- Hero Section -->
    <section class="bg-primaryBg p-8 text-center mt-20">
        <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Tambah Produk</h1>
        <p class="text-gray-600 mt-2 lg:text-lg">Tambah produk baru untuk toko Anda</p>
    </section>

    <!-- Form Tambah Produk -->
    <section class="py-8 mx-4">
        <div class="bg-white shadow rounded-lg p-6">
            <form action="{{ route('admin.save-product') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="productForm">
                @csrf
                <!-- Nama Produk -->
                <div>
                    <label for="product_name" class="block text-xl font-medium text-gray-700">Nama Produk</label>
                    <input type="text" name="product_name" id="product_name" required
                        class="mt-1 py-4 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" placeholder="Masukkan nama produk">
                </div>

                <!-- Kategori Produk -->
                <div>
                    <label for="category" class="block text-xl font-medium text-gray-700">Kategori Produk</label>
                    <div class="relative">
                        <select name="category_id" id="category" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                            <option value="" disabled selected>Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->category_id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>

                        <!-- Tombol untuk Menambahkan Kategori Baru -->
                        <button type="button" id="addCategoryBtn" class="text-sm text-blue-600 hover:text-blue-800 mt-2 absolute top-1 right-2">Tambah Kategori Baru</button>
                    </div>

                    <!-- Input kategori baru, disembunyikan sampai tombol ditekan -->
                    <div id="newCategoryDiv" class="hidden mt-2">
                        <label for="new_category" class="block text-xl font-medium text-gray-700">Kategori Baru</label>
                        <input type="text" id="new_category" name="new_category" class="mt-1 py-4 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" placeholder="Masukkan nama kategori baru">
                    </div>
                </div>

                <!-- Harga Produk -->
                <div>
                    <label for="price" class="block text-xl font-medium text-gray-700">Harga (Rp)</label>
                    <input type="text" name="price" id="price" required 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                        placeholder="Contoh: 50.000" onkeyup="formatPrice()">
                </div>

                <!-- Deskripsi Produk -->
                <div>
                    <label for="description" class="block text-xl font-medium text-gray-700">Deskripsi</label>
                    <textarea name="description" id="description" rows="4" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" placeholder="Masukkan deskripsi produk"></textarea>
                </div>

                <!-- Upload Gambar Produk -->
                <div>
                    <label for="product_image" class="block text-xl font-medium text-gray-700">Gambar Produk</label>
                    <input type="file" name="product_image" id="product_image" accept="image/*" required enctype="multipart/form-data"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-green-500 text-white px-6 py-3 rounded-md text-sm font-semibold hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                        Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>

<!-- SweetAlert -->
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

    function formatPrice() {
        var priceInput = document.getElementById('price');
        var value = priceInput.value.replace(/[^\d]/g, '');

        if (value) {
            value = 'Rp. ' + value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        priceInput.value = value;
    }

    document.getElementById('productForm').addEventListener('submit', function(event) {
        let categoryInput = document.getElementById('new_category').value.trim();
        let categoryDropdown = document.getElementById('category').value;

        if (!categoryDropdown && !categoryInput) {
            event.preventDefault();
            Swal.fire('Error', 'Pilih kategori atau masukkan kategori baru', 'error');
        }
    });

    @if (session('success'))
    <script>
        Swal.fire({
            title: 'Produk Berhasil Ditambahkan!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'Tutup'
        });
    </script>
@endif

</script>
@endsection
