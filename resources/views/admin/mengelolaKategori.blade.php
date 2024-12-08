@extends('components.template')
@include('components.sidebarAdmin')
@section('title', 'Kelola Kategori Produk')
@section('content')
<div class="ml-56 flex-1">
    <!-- Hero Section -->
    <section class="bg-primaryBg p-8 text-center mt-20">
        <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Kelola Kategori Produk</h1>
        <p class="text-gray-600 mt-2 lg:text-lg">Kelola kategori produk yang tersedia di platform Anda</p>
    </section>

    <!-- Daftar Kategori Produk -->
    <section class="py-8 mx-4">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="p-4 bg-green-500 text-white font-bold text-lg border-b">
                Daftar Kategori Produk
            </div>
            <div class="overflow-x-auto">
                <table class="table-auto w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700 text-sm uppercase tracking-wider">
                            <th class=" px-4 py-2 border">ID Kategori</th>
                            <th class="px-4 py-2 border">Nama Kategori</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-gray-800">{{ $category->category_id }}</td>
                            <td class="px-4 py-2 border text-gray-800">{{ $category->name }}</td>
                            <td class="px-4 py-2 border">
                            <form action="{{ route('admin.delete-category', $category->category_id) }}" method="POST" onsubmit="return confirmDelete();">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 text-white px-4 py-1 rounded text-sm hover:bg-red-600 ml-2">
                                    Hapus
                                </button>
                            </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-4 py-6 text-center text-gray-500">
                                Tidak ada kategori yang tersedia saat ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

</div>
<script>
    function confirmDelete() {
        return Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan dapat mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            return result.isConfirmed;
        });
    }
</script>
@endsection
