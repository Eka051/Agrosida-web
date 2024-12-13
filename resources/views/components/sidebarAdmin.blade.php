<aside class="w-56 h-screen bg-greenPrimary text-black fixed border-r border-gray-300">
    <div class="p-4 text-center font-bold text-xl border-b border-green-700">
        AGROSIDA
    </div>
    <nav class="mt-6">
        <ul class="space-y-2">
            <li>
                <a href="{{route('admin.dashboard')}}" class="block py-2 px-3 rounded hover:bg-green-500">Beranda</a>
            </li>
            <li>
                <a href="{{ route('admin.userManagement') }}" class="block py-2 px-3 rounded hover:bg-green-500">Kelola Pengguna</a>
            </li>
            <li>
                <a href="{{ route('admin.view-product') }}" class="block py-2 px-3 rounded hover:bg-green-500 ">Kelola Produk</a>
            </li>
            <li>
                <a href="" class="block py-2 px-3 rounded hover:bg-green-500">Kelola Transaksi</a>
            </li>
            <li>
                <a href="{{ route('admin.view-category') }}" class="block py-2 px-3 rounded hover:bg-green-500">Kelola Kategori Produk</a>
            </li>
            <li>
                <a href="" class="block py-2 px-3 rounded hover:bg-green-500">Kelola Kalkulasi Pestisida</a>
            </li>
        </ul>
    </nav>
</aside>