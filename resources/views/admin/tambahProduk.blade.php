@extends('components.template')
@include('components.sidebarAdmin')
@section('title', 'Tambah Produk')
@section('content')
<div class="ml-56 flex-1">
    <!-- Hero Section -->
    <section class="bg-primaryBg p-8 text-center mt-20">
        <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Tambah Produk</h1>
        <p class="text-gray-600 mt-2 lg:text-lg">Form untuk menambahkan produk baru ke platform</p>
    </section>

    <!-- Form Tambah Produk -->
    <section class="py-8 mx-4">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="p-4 bg-green-500 text-white font-bold text-lg border-b">
                Tambah Produk
            </div>
            <form action="{{ route('admin.tambahproduk') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                <div class="mb-4">
                    <label for="idProduk" class="block text-gray-700 font-bold mb-2">ID Produk</label>
                    <input type="text" name="idProduk" id="idProduk" 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" 
                           placeholder="Contoh: PRD001" required>
                </div>
                <div class="mb-4">
                    <label for="namaProduk" class="block text-gray-700 font-bold mb-2">Nama Produk</label>
                    <input type="text" name="namaProduk" id="namaProduk" 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" 
                           placeholder="Masukkan nama produk" required>
                </div>
                <div class="mb-4">
                    <label for="kategoriProduk" class="block text-gray-700 font-bold mb-2">Kategori Produk</label>
                    <select name="kategoriProduk" id="kategoriProduk" 
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" 
                            required>
                        <option value="">Pilih Kategori</option>
                        <option value="pestisida">Pestisida</option>
                        <option value="alatPertanian">Alat Pertanian</option>
                        <option value="bibitTanaman">Bibit Tanaman</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="hargaProduk" class="block text-gray-700 font-bold mb-2">Harga Produk</label>
                    <input type="number" name="hargaProduk" id="hargaProduk" 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" 
                           placeholder="Masukkan harga produk" required>
                </div>
                <div class="mb-4">
                    <label for="stokProduk" class="block text-gray-700 font-bold mb-2">Stok Produk</label>
                    <input type="number" name="stokProduk" id="stokProduk" 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" 
                           placeholder="Masukkan jumlah stok produk" required>
                </div>
                <div class="mb-4">
                    <label for="deskripsiProduk" class="block text-gray-700 font-bold mb-2">Deskripsi Produk</label>
                    <textarea name="deskripsiProduk" id="deskripsiProduk" rows="4" 
                              class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" 
                              placeholder="Masukkan deskripsi produk" required></textarea>
                </div>
                <div class="mb-4">
                    <label for="gambarProduk" class="block text-gray-700 font-bold mb-2">Upload Gambar Produk</label>
                    <input type="file" name="gambarProduk" id="gambarProduk" 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" 
                           accept="image/*" required>
                </div>
                <div class="flex justify-end">
                    <button type="submit" 
                            class="bg-green-500 text-white px-6 py-2 rounded-md text-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
