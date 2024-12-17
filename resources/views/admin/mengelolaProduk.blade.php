@extends('components.template')
@include('components.sidebarAdmin')
@section('title', 'Kelola Produk')
@section('content')
<div class="ml-64 flex-1 mt-[4.5rem]">
    <section class="p-2">
        <div class="container ml-4">
            <nav class="text-lg">
                <ol class="list-reset flex text-gray-600">
                    <li><a href="{{ route('admin.dashboard') }}" class="text-green-500 hover:text-green-700">Beranda</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li>Kelola Produk</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="p-6">
        <div class="container">
            <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Kelola Produk</h1>
            <p class="text-gray-600 mt-2 lg:text-lg">Kelola produk yang tersedia di marketplace</p>
        </div>
    </section>

    <section class="p-4 bg-gray-100">
        <input type="text" id="search" placeholder="Cari produk atau kategori..." 
               class="px-4 py-2 border rounded w-full focus:ring-2 focus:ring-green-500 focus:outline-none">
    </section>
    

    <section class="py-8 mx-4">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="p-4 bg-green-500 text-white font-bold text-lg border-b">
                Daftar Produk
            </div>

            <div class="overflow-x-auto">
                <table class="table-auto w-full text-left border-collapse whitespace-normal" id="productTable">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700 text-base uppercase">
                            <th class="px-4 py-2 border">Nama Toko</th>
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
                            <td class="px-4 py-2 border text-gray-800">{{ $product->user->store->name ?? '-' }}</td>
                            <td class="px-4 py-2 border">
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}"
                                     class="w-full h-24 object-contain">
                            </td>
                            <td class="px-4 max-w-[20rem] py-2 border text-gray-800">{{ $product->product_name }}</td>
                            <td class="px-4 py-2 border text-gray-800">{{ $product->category->name ?? '-' }}</td>
                            <td class="px-4 max-w-[18rem] py-2 border text-gray-800">{{ $product->description }}</td>
                            <td class="px-4 py-2 border text-gray-800">Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 border text-gray-800">{{ $product->stock }}</td>
                            <td class="px-4 py-2 border">
                                <span class="px-2 py-1 rounded text-white 
                                    {{ $product->discontinued == 1 ? 'bg-red-500' : 'bg-green-500' }}">
                                    {{ $product->discontinued == 1 ? 'Discontinue' : 'Tersedia' }}
                                </span>
                            </td>
                            <td class="px-4 py-2 border">
                                <button type="button" onclick="confirmDelete('{{ route('admin.delete-product', $product->id) }}')"
                                       class="bg-red-500 text-white px-4 py-1 rounded text-sm hover:bg-red-600">
                                       Hapus
                                </button>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(actionUrl) {
        Swal.fire({
            title: 'Hapus Produk',
            text: 'Apakah Anda yakin ingin menghapus produk ini? Tindakan ini tidak dapat dibatalkan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {

                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    document.getElementById('search').addEventListener('input', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#productTable tbody tr');

        rows.forEach(row => {
            let productName = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
            let category = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
            if (productName.includes(filter) || category.includes(filter)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>

@endsection