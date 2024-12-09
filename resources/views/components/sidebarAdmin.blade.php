<!-- Sidebar -->
<aside class="w-56 h-screen bg-greenPrimary text-black fixed border-r border-gray-300">
    <div class="p-4 text-center font-bold text-xl border-b border-green-700">
        AGROSIDA
    </div>
    <nav class="mt-6">
        <ul class="space-y-2">
            <li>
                <a href="{{route('admin.dashboard')}}" class="block py-2 px-3 rounded hover:bg-green-500 {{ Route::currentRouteName() === 'admin.dashboard' ? 'bg-green-500 text-white' : '' }}">Beranda</a>
            </li>
            <li>
                <a href="{{ route('admin.userManagement') }}" class="block py-2 px-3 rounded hover:bg-green-500 {{ Route::currentRouteName() === 'admin.userManagement' ? 'bg-green-500 text-white' : '' }}">Kelola Pengguna</a>
            </li>
            <li>
                <a href="{{ route('admin.view-product') }}" class="block py-2 px-3 rounded hover:bg-green-500 {{ Route::currentRouteName() === 'admin.view-product' ? 'bg-green-500 text-white' : '' }}">Kelola Produk</a>
            </li>
            <li>
                <a href="" class="block py-2 px-3 rounded hover:bg-green-500 {{ Route::currentRouteName() === 'admin.transaksi' ? 'bg-green-500 text-white' : '' }}">Kelola Transaksi</a>
            </li>
            <li>
                <a href="{{ route('admin.view-category') }}" class="block py-2 px-3 rounded hover:bg-green-500 {{ Route::currentRouteName() === 'admin.view-category' ? 'bg-green-500 text-white' : '' }}">Kelola Kategori Produk</a>
            </li>
            <li>
                <a href="" class="block py-2 px-3 rounded hover:bg-green-500 {{ Route::currentRouteName() === 'admin.kalkulasipestisida' ? 'bg-green-500 text-white' : '' }}">Kelola Kalkulasi Pestisida</a>
            </li>
            <li>
                <a href="{{ route('detect.form') }}" class="block py-2 px-3 rounded hover:bg-green-500 {{ Route::currentRouteName() === 'detect.form' ? 'bg-green-500 text-white' : '' }}">Kelola Kategori Produk</a>
            </li>
        </ul>
    </nav>
</aside>
